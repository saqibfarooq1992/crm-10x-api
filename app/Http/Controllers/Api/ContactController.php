<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Imports\ContactImport;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\File;
use App\Models\Social;
use App\Services\ContactServices;
use App\Traits\Jsonify;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Client;
use App\Exports\ContactExport;
class ContactController extends Controller
{
    use Jsonify;
    private $contactServices;
    public function __construct(ContactServices $contactServices)
    {
        parent::__permissions('contacts');
        $this->contactServices = $contactServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->contactServices->search();
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $contact = $this->contactServices->create($request);
            return $contact;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
       try {
         //   $contact = Contact::find($id);
           return self::jsonSuccess('Contact retrieved successfully.',$contact, 200);
       } catch (\Throwable $th) {
        //throw $th;
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            $contact = $this->contactServices->update($request , $contact);
            return $contact;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact = $this->contactServices->delete($contact);
            return $contact;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function pipeline(Request $request)
    {
        try {
            $data = $this->contactServices->pipeline($request);
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function social(Request $request)
    {
        try {
            $social = Social::create([
                'contact_id' => $request->contact_id,
                'type' => $request->type,
                'url' => $request->url,
            ]);
            return self::jsonSuccess("Social link created successfully",$social, 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function upload(Request $request)
    {
        try {
            $id = $request->contact_id;
            $request->validate([
                'file' =>'required',
            ]);
            if ($request->hasFile('file')) {
                $data = $id.'_'.time().'.'.$request->file->extension();
                $request->file->move(public_path('file'), $data);
                $data = File::create([
                    'contact_id' => $id,
                    'file' => $data,
                ]);
                return response()->json([
                    'message' => 'File Created successfully',
                    'data' => $data,
                    'code' => 200
                 ]);
            }else {
                return response()->json([
                    'message' => 'Something went wrong',
                    'code' => 500
                 ]);
            }
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
    }
    public function task(Request $request)
    {
        try {

            $data = $this->contactServices->task($request);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function assignment(Request $request)
    {
        try {
            $data = $this->contactServices->assignment($request);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function notes(Request $request)
    {
        try {
            $data = $this->contactServices->notes($request);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function email(Request $request)
    {   
        try {
            $data = $this->contactServices->email($request);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function sms(Request $request)
    {
        try {
            $receiverNumber = $request->phone; // Replace with the recipient's phone number
            $message = $request->message; // Replace with your desired message
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_TOKEN');
            $fromNumber = env('TWILIO_PHONE');

            try {
                $client = new Client($sid, $token);
                $client->messages->create($receiverNumber, [
                    'from' => $fromNumber,
                    'body' => $message
                ]);

                return 'SMS Sent Successfully.';
            } catch (Exception $e) {
                return 'Error: ' . $e->getMessage();
            }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function call()
    {
        try {
            $sid = getenv("TWILIO_SID");
            $token = getenv("TWILIO_TOKEN");
            $sender = getenv("TWILIO_PHONE");

            $twilio = new Client($sid, $token);
            $call = $twilio->calls
               ->create("+923329793551", // to
                        $sender, // from
                        ["url" => "http://demo.twilio.com/docs/voice.xml"]
               );
                return $call;
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
    public function import(Request $request)
    {
        try {
            $file = $request->file('file');

            $contact = Excel::import(new ContactImport, $file);

            return self::jsonSuccess("Contact imported successfully",$contact, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function export()
    {
        try {
             Excel::download(new ContactExport, 'contacts.xlsx');
             return self::jsonSuccess("Contact export successfully");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
