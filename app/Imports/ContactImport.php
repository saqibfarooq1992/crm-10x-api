<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Contact;
class ContactImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
    public function model(array $row)
    {
        try {
            // Remove the 'id' field from the $row array
            unset($row['id']);
            // Convert Excel date value to a valid date format
            $birthday = date('Y-m-d', strtotime('1899-12-30 + ' . ($row['birthday'] - 1) . ' days'));
            $anniversary_date_of_purchase = date('Y-m-d', strtotime('1899-12-30 + ' . ($row['anniversary_date_of_purchase'] - 1) . ' days'));
            $anniversary_date_of_sale = date('Y-m-d', strtotime('1899-12-30 + ' . ($row['anniversary_date_of_sale'] - 1) . ' days'));

         // Create a new Contact instance with the remaining fields
        $contact = new Contact([
            'contact_type' => $row['contact_type'],
            'transaction_associate' => $row['transaction_associate'],
            'assign_title' => $row['assign_title'],
            'tags' => $row['tags'],
            'f_name' => $row['f_name'],
            'm_name' => $row['m_name'],
            'l_name' => $row['l_name'],
            'n_name' => $row['n_name'],
            'email' => $row['email'],
            'company' => $row['company'],
            'cell_phone' => $row['cell_phone'],
            'office_phone' => $row['office_phone'],
            'intrusted_in_properties' => $row['intrusted_in_properties'],
            'preferred_contact_method' => $row['preferred_contact_method'],
            'contact_source' => $row['contact_source'],
            'contact_notes' => $row['contact_notes'],
            'attached_file' => $row['attached_file'],
            'birthday' => $birthday,
            'hobbies' => $row['hobbies'],
            'spouce' => $row['spouce'],
            'children_name' => $row['children_name'],
            'anniversary_date_of_purchase' => $anniversary_date_of_purchase,
            'anniversary_date_of_sale' => $anniversary_date_of_sale,
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);

        // Save the Contact instance
        $contact->save();
        // Return the saved Contact instance
        return $contact;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
