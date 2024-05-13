<?php

namespace App\Services;

use App\Http\Resources\Collections\ContactCollection;
use App\Http\Resources\Permissions\ContactResource;
use App\Mail\ContactEmail as MailContactEmail;
use Illuminate\Http\Request;
use App\Models\ContactEmail;
use App\Models\Assignment;
use App\Models\Contact;
use App\Models\Note;
use App\Models\Task;
use App\Traits\Jsonify;

use Illuminate\Support\Facades\Mail;

class ContactServices
{
    use Jsonify;
    private $model;
    /**
     * Create a new class instance.
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }
    public function search()
    {
        $contacts = $this->model->get();
        $data = (new ContactCollection($contacts));
            return self::jsonSuccess('Contacts retrieved successfully.',$data, 200);
    }
    public function create($request)
    {
        $contact = $this->model->create([
            'contact_type' => $request->contact_type,
            'transaction_associate' => $request->transaction_associate,
            'assign_title' => $request->assign_title,
            'tags' => $request->tags,
            'f_name' => $request->f_name,
            'm_name' => $request->m_name,
            'l_name' => $request->l_name,
            'n_name' => $request->n_name,
            'email' => $request->email,
            'company' => $request->company,
            'cell_phone' => $request->cell_phone,
            'office_phone' => $request->office_phone,
            'intrusted_in_properties' => $request->intrusted_in_properties,
            'preferred_contact_method' => $request->preferred_contact_method,
            'contact_source' => $request->contact_source,
            'contact_notes' => $request->contact_notes,
            'attached_file' => $request->attached_file,
            'birthday' => $request->birthday,
            'hobbies' => $request->hobbies,
            'spouce' => $request->spouce,
            'children_name' => $request->children_name,
            'anniversary_date_of_purchase' => $request->anniversary_date_of_purchase,
            'anniversary_date_of_sale' => $request->anniversary_date_of_sale,
        ]);
        return self::jsonSuccess("Contact created successfully",new ContactResource($contact), 200);
    }
    public function update($request, $contact)
    {
        try {
            $contact->update([
                'contact_type' => $request->contact_type,
                'transaction_associate' => $request->transaction_associate,
                'assign_title' => $request->assign_title,
                'tags' => $request->tags,
                'f_name' => $request->f_name,
                'm_name' => $request->m_name,
                'l_name' => $request->l_name,
                'n_name' => $request->n_name,
                'email' => $request->email,
                'company' => $request->company,
                'cell_phone' => $request->cell_phone,
                'office_phone' => $request->office_phone,
                'intrusted_in_properties' => $request->intrusted_in_properties,
                'preferred_contact_method' => $request->preferred_contact_method,
                'contact_source' => $request->contact_source,
                'contact_notes' => $request->contact_notes,
                'attached_file' => $request->attached_file,
                'birthday' => $request->birthday,
                'hobbies' => $request->hobbies,
                'spouce' => $request->spouce,
                'children_name' => $request->children_name,
                'anniversary_date_of_purchase' => $request->anniversary_date_of_purchase,
                'anniversary_date_of_sale' => $request->anniversary_date_of_sale,
            ]);
            return self::jsonSuccess("Contact updated successfully",new ContactResource($contact), 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete($contact)
    {
        try {
            $contact->delete();
            return self::jsonSuccess("Contact deleted successfully");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function pipeline($request)
    {
        $contact = $this->model->create([
            'pipeline' => $request->pipeline,
        ]);
        $contact-save();
    }
    public function show()
    {
        $contacts = $this->model->get();
        $data = (new ContactCollection($contacts));
            return self::jsonSuccess('Contacts retrieved successfully.',$data, 200);
    }
    public function task($request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'assign_to_agent' => 'required|string',
                'start_date' => 'required',
                'deadline_date' => 'required',
                'type' => 'required|string',
                'priority' => 'required|string',
                'description' => 'required|string',
            ]);
            $id = $request->contact_id;
            // Create a new Task instance
            $task = new Task();

            // Assign values from the form to the Task object
            $task->name = $validatedData['name'];
            $task->contact_id = $id;
            $task->assign_to_agent = $validatedData['assign_to_agent'];
            $task->start_date = $validatedData['start_date'];
            $task->end_on_date = $request['end_on_date'];
            $task->deadline_date = $validatedData['deadline_date'];
            $task->type = $validatedData['type'];
            $task->priority = $validatedData['priority'];
            $task->description = $validatedData['description'];
            $task->task_reminder = $request->input('task-reminder'); // Corrected access method

            // Handle tags
            if ($request->has('tags')) {
                $task->tags = json_encode($request->input('tags'));
            }

            // Handle repeat
            if ($request->input('task-reminder') === 'weekly') {
                // Set the values for each day of the week
                $task->monday = $request->input('monday') ? 1 : 0;
                $task->tuesday = $request->input('tuesday') ? 1 : 0;
                $task->wednesday = $request->input('wednesday') ? 1 : 0;
                $task->thursday = $request->input('thursday') ? 1 : 0;
                $task->friday = $request->input('friday') ? 1 : 0;
                $task->saturday = $request->input('saturday') ? 1 : 0;
                $task->sunday = $request->input('sunday') ? 1 : 0;

                $task->repeat = json_encode(['type' => 'weekly']);
            } elseif ($request->input('task-reminder') === 'monthly') {
                // Handle monthly repeat
                $task->repeat = json_encode(['type' => 'monthly', 'day_of_month' => $request->input('year-date-range')]);
            }

            // Save the Task to the database
            $task->save();

            // Redirect back or wherever you need
            return self::jsonSuccess('Task retrieved successfully.', $task, 200);
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
    }

    public function assignment($request)
    {
        try {
            $validatedData = $request->validate([
                'name.*' => 'required|string',
                'title.*' => 'required|string',
                'email.*' => 'required|email',
                'phone.*' => 'required|string',
            ]);
        
            // Create an array to hold the assignment data
            $assignments = [];
            $id = $request->contact_id;
            // Loop through the submitted data and create assignments
            foreach ($validatedData['name'] as $index => $name) {
                $assignment = new Assignment();
                $assignment->contact_id = $id;
                $assignment->name = json_encode($name); // Encode the name array to JSON
                $assignment->title = json_encode($validatedData['title'][$index]); // Encode the title array to JSON
                $assignment->email = json_encode($validatedData['email'][$index]); // Encode the email array to JSON
                $assignment->phone = json_encode($validatedData['phone'][$index]); // Encode the phone array to JSON
                $assignment->save();
                $assignments[] = $assignment;
            }
        
            return response()->json(['message' => 'Assignments created successfully.', 'assignments' => $assignments], 201);
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
    }

    public function notes($request)
    {
        try {
            $validatedData = $request->validate([
                'note' =>'required|string',
            ]);
            $id = $request->contact_id;
            $note = new Note();
            $note->contact_id = $id;
            $note->note = $validatedData['note'];
            $note->save();
            return response()->json(['message' => 'Note created successfully.', 'note' => $note], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function email(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cc_emails' =>'required|array',
                'subject' =>'required|string',
                'message' =>'required|string',
            ]);
    
            $cc_emails = implode(',', $request->input('cc_emails'));
            $subject = $request->input('subject');
            $message = $request->input('message');
            $id = $request->input('contact_id');
            $contactEmail = Contact::find($id);
            $email = new ContactEmail();
            $email->contact_id = $id;
            $email->to_email = $contactEmail->email;
            $email->cc_emails = $cc_emails;
            $email->subject = $subject;
            $email->message = $message;
            if ($email->save()) {
                $contactData = [
                    'subject' => $email->subject,
                    'to_email'     => $email->to_email,
                    'f_name' => $contactEmail->f_name,
                    'message'   =>  $email->message,
                ];
                try {
                    Mail::to($email->to_email)
                    ->cc(explode(',', $cc_emails)) // Convert back to array for Mail::cc()
                    ->send(new MailContactEmail($contactData));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    return response()->json([
                        'message'     => 'Some error occurred, please try again',
                        'status_code' => 500,
                    ], 500);
                }
    
                return response()->json(['message' => 'Email created successfully.', 'email' => $email], 200);
                
            } else {
                return response()->json([
                    'message'     => 'Some error occurred, please try again',
                    'status_code' => 500,
                ], 500);
            }
           
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    
    
}
