<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $companies = Company::paginate(1);

        return view('companies.index', [
            'companies' => $companies
        ]);
    }

    public function register()
    {
        if (auth()->user()->role !== "user") {
            return view('companies.register');
        } else {
            return redirect()->route('entreprises');
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies|max:255',
            'street' => 'required|max:255',
            'zip_code' => 'required|alpha_num|max:5',
            'city' => 'required|max:255',
            'phone' => 'required|unique:companies|regex: /^(\d{3})(\d{3})(\d{4})$/',
            'email' => 'required|email|unique:companies|max:255',
        ]);

        Company::create([
            'name' => $request->name,
            'street' => $request->street,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('entreprises');
    }

    public function show(Request $request)
    {

        $company = Company::where('id', '=', $request->id)->get();

        return view('companies.show', [
            'companies' => $company
        ]);
    }

    public function update(Request $request)
    {
        if (auth()->user()->role !== "user") {

            $company = Company::find($request->id);

            return view('companies.update', [
                'company' => $company
            ]);
        } else {
            return redirect()->route('entreprises');
        }
    }

    public function updateCompany(Request $request)
    {
        $company = Company::find($request->id);
        $this->validate($request, [
            'id' => 'required',
            'name' => ($company->name !== $request->name) ? 'required|unique:companies|max:255' : 'required',
            'street' => 'required|max:255',
            'zip_code' => 'required|alpha_num|max:5',
            'city' => 'required|max:255',
            'phone' => ($company->phone !== $request->phone) ? 'required|unique:companies|regex:/^(\d{3})(\d{3})(\d{4})$/' : 'required',
            'email' => ($company->email !== $request->email) ? 'required|email|unique:companies' : 'required',
        ]);

        $company->name = $request->name;
        $company->street = $request->street;
        $company->zip_code = $request->zip_code;
        $company->city = $request->city;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->save();

        return redirect()->route('entreprises');
    }

    public function destroy(Request $request)
    {
        if (auth()->user()->role === "admin") {

            $company = Company::find($request->id);
            $company->delete();

            return back();
        } else {
            return redirect()->route('entreprises');
        }
    }


    public function action(Request $request)
    {
        if ($request->get('query')) {

            $query = $request->get('query');
            $output = '';

            if ($query != '') {
                $companies = DB::table('companies')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('city', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {

                return array(
                    'table_data' => 'Aucun résultat',
                    'total_data' => 0
                );
            }

            $total = $companies->count();
            if ($total > 0) {
                foreach ($companies as $company) {

                    $output .= '
                    <tr>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="/entreprises/' . $company->id . '">' . $company->name . '</a></td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->phone . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->email . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->zip_code . '</td>';
                    if (auth()->user()->role !== "user") {
                        $output .= '<td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="/entreprises/update/' . $company->id . '" class="bg-blue-600 p-3 rounded-lg text-white">éditer</a></td>';
                    }
                    if (auth()->user()->role === "admin") {
                        $output .= '
                        <td class="border-solid border-2 p-3 border-gray-500 text-center">
                        <form action="/entreprise/delete/' . $company->id . '" method="post">
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
