<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Retrieve all contacts from the database
        $contacts = Contact::all();

        // Transform the data into the format you want to export
        $exportData = $contacts->map(function ($contact) {
            return [
                'ID' => $contact->id,
                'Contact Type' => $contact->contact_type,
                'Transaction Associate' => $contact->transaction_associate,
                'Assign Title' => $contact->assign_title,
                'Tags' => $contact->tags,
                'First Name' => $contact->f_name,
                'Middle Name' => $contact->m_name,
                'Last Name' => $contact->l_name,
                'Nick Name' => $contact->n_name,
                'Email' => $contact->email,
                'Company' => $contact->company,
                'Cell Phone' => $contact->cell_phone,
                'Office Phone' => $contact->office_phone,
                'Intrusted in Properties' => $contact->intrusted_in_properties,
                'Preferred Contact Method' => $contact->preferred_contact_method,
                'Contact Source' => $contact->contact_source,
                'Contact Notes' => $contact->contact_notes,
                'Attached File' => $contact->attached_file,
                'Birthday' => $contact->birthday,
                'Hobbies' => $contact->hobbies,
                'Spouse' => $contact->spouce,
                'Children Name' => $contact->children_name,
                'Anniversary Date of Purchase' => $contact->anniversary_date_of_purchase,
                'Anniversary Date of Sale' => $contact->anniversary_date_of_sale,
                'Created At' => $contact->created_at,
                'Updated At' => $contact->updated_at,
            ];
        });

        return $exportData;
    }
    public function headings(): array
    {
        // Define the column headings for the exported file
        return [
            'ID',
            'Contact Type',
            'Transaction Associate',
            'Assign Title',
            'Tags',
            'First Name',
            'Middle Name',
            'Last Name',
            'Nick Name',
            'Email',
            'Company',
            'Cell Phone',
            'Office Phone',
            'Intrusted in Properties',
            'Preferred Contact Method',
            'Contact Source',
            'Contact Notes',
            'Attached File',
            'Birthday',
            'Hobbies',
            'Spouse',
            'Children Name',
            'Anniversary Date of Purchase',
            'Anniversary Date of Sale',
            'Created At',
            'Updated At',
        ];
    }
}
