<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contributors = DB::table('contributors')->join('companies', 'companies.id', '=', 'contributors.company_id')->select('contributors.*', 'companies.name', 'companies.phone as company_phone')->paginate(1);

        return view('contributors.index', [
            'contributors' => $contributors
        ]);
    }

    public function register()
    {
        if (auth()->user()->role !== "user") {
            $companies = Company::all();
            return view('contributors.register', [
                'companies' => $companies
            ]);
        } else {
            return redirect()->route('collaborateurs');
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'street' => 'required|max:255',
            'zip_code' => 'required|alpha_num|max:5',
            'city' => 'required|max:255',
            'phone' => 'required|unique:contributors|regex: /^(\d{3})(\d{3})(\d{4})$/',
            'email' => 'required|email|unique:contributors',
            'company_id' => 'required',
        ]);

        Contributor::create([
            'civility' => (isset($request->civility) ? $request->civility : 'not_specified'),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('collaborateurs');
    }

    public function show(Request $request)
    {

        $contributors = DB::table('contributors')->join('companies', 'companies.id', '=', 'contributors.company_id')->select('contributors.*', 'companies.name', 'companies.phone as company_phone')->where('contributors.id', '=', $request->id)->get();

        return view('contributors.show', [
            'contributors' => $contributors
        ]);
    }

    public function update(Request $request)
    {
        if (auth()->user()->role !== "user") {

            $contributors = DB::table('contributors')->join('companies', 'companies.id', '=', 'contributors.company_id')->select('contributors.*', 'companies.name', 'companies.phone as company_phone')->where('contributors.id', '=', $request->id)->get();

            $companies = Company::all();

            return view('contributors.update', [
                'contributors' => $contributors,
                'companies' => $companies
            ]);
        } else {
            return redirect()->route('collaborateurs');
        }
    }

    public function updateContributor(Request $request)
    {
        $contributor = Contributor::find($request->id);
        $this->validate($request, [
            'id' => 'required',
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'street' => 'required|max:255',
            'zip_code' => 'required|alpha_num|max:5',
            'city' => 'required|max:255',
            'phone' => ($contributor->phone !== $request->phone) ? 'required|unique:contributors|regex: /^(\d{3})(\d{3})(\d{4})$/' : 'required',
            'email' => ($contributor->email !== $request->email) ? 'required|email|unique:contributors' : 'required',
            'company_id' => 'required',
        ]);

        $contributor->civility = (isset($request->civility) ? $request->civility : 'not_specified');
        $contributor->last_name = $request->last_name;
        $contributor->first_name = $request->first_name;
        $contributor->street = $request->street;
        $contributor->zip_code = $request->zip_code;
        $contributor->city = $request->city;
        $contributor->phone = $request->phone;
        $contributor->email = $request->email;
        $contributor->company_id = $request->company_id;
        $contributor->save();

        return redirect()->route('collaborateurs');
    }

    public function destroy(Request $request)
    {
        if (auth()->user()->role === "admin") {

            $contributor = Contributor::find($request->id);
            $contributor->delete();

            return back();
        } else {
            return redirect()->route('collaborateurs');
        }
    }

    public function action(Request $request)
    {
        if ($request->get('query')) {

            $query = $request->get('query');
            $output = '';

            if ($query != '') {

                $contributors = DB::table('contributors')
                    ->join('companies', 'companies.id', '=', 'contributors.company_id')
                    ->select('contributors.*', 'companies.name', 'companies.phone as company_phone')
                    ->where('last_name', 'like', '%' . $query . '%')
                    ->orWhere('first_name', 'like', '%' . $query . '%')
                    ->orWhere('companies.phone', 'like', '%' . $query . '%')
                    ->orWhere('contributors.phone', 'like', '%' . $query . '%')
                    ->orWhere('contributors.email', 'like', '%' . $query . '%')
                    ->orWhere('companies.name', 'like', '%' . $query . '%')
                    ->orderBy('contributors.id', 'desc')
                    ->get();
            } else {

                return array(
                    'table_data' => 'Aucun résultat',
                    'total_data' => 0
                );
            }

            $total = $contributors->count();
            if ($total > 0) {
                foreach ($contributors as $contributor) {

                    $output .= '
                    <tr>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="/collaborateurs/' . $contributor->id . '">' . $contributor->last_name . '</a></td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $contributor->first_name . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $contributor->phone . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $contributor->email . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $contributor->name . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $contributor->company_phone . '</td>';
                    if (auth()->user()->role !== "user") {
                        $output .= '<td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="/collaborateurs/update/' . $contributor->id . '" class="bg-blue-600 p-3 rounded-lg text-white">éditer</a></td>';
                    }
                    if (auth()->user()->role === "admin") {
                        $output .= '
                        <td class="border-solid border-2 p-3 border-gray-500 text-center">
                        <form action="/collaborateur/delete/' . $contributor->id . '" method="post">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="bg-red-600 p-3 rounded-lg text-white">X</button>
                        </form>
                        </td>
                        ';
                    }
                    $output .= '
                    </tr>
                    ';
                }
            } else {
                return array(
                    'table_data' => 'Aucun résultat',
                    'total_data' => 0
                );
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total
            );

            return $data;
        }
    }
}
