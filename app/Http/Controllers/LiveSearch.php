<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveSearch extends Controller
{
    public function index()
    {
        return redirect()->route('entreprises');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $companies = DB::table('companies')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('city', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                return redirect()->route('entreprises');
            }

            $total = $companies->count();
            if ($total > 0) {
                foreach ($companies as $company) {
                    $output .= '
                    <tr>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->name . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->phone . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->email . '</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">' . $company->zip_code . '</td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                    <tr>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">L\'entreprise rechrchée n\'existe pas ...</td>
                    </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total
            );

            echo json_encode($data);
        }
    }
}
