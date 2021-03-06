<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\DocumentNotSetForApproval;
use App\Http\Controllers\Controller;
use App\Http\Resources\Document\ApprovalDocumentResource;
use App\Http\Resources\Document\ApprovedDocument;
use App\Http\Resources\Document\DeniedDocument;
use App\Http\Resources\Document\DocumentCollection;
use App\Http\Resources\Document\DocumentResource;
use App\Model\Document;
use App\Model\Batch;
use App\Model\DocumentList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OwnerDocumentImport;


class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return DocumentCollection::collection( Document::where('approved_status', Document::PENDING[1])->get() );


    }

    public function import()
    {
        return "djdj";

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return new DocumentResource( $document );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    public function document()
    {
        $documentList = DocumentList::all();
        return $documentList;
    }

    public function OwnerDocuments(){
        return "Yes";
    }

    public function getAllSetForApprovalDocuments(){

        $document = Document::all()->reject(function ($document) {
            return $document->set_for_approval_status == null;
        })
            ->filter(function ($document) {
                return $document->approved_status == Document::AWAITING[1];
            });


        $documents = ApprovalDocumentResource::collection($document);

        return $documents;
    }

    public function DocumentStatusProcessor(Request $request, Document $document){
        $request->validate([
            'status' => 'required|string|max:255',
            'message' => 'bail',
            'createdAt' => 'required|date|max:255',
            ],
            [
                'documentId.required' => 'Document Id is require!',
                'status.required' => 'Status is require!'

            ]);

            if (!$document->set_for_approval_status) {
                throw new DocumentNotSetForApproval;
            }

        $status = strtolower($request->get('status')) == 'approved' ? 1 : 0;
        $updateStatusCode = Document::DECLINED[1];
        $updateStatusText = Document::DECLINED[0];
        if ($status == 1){
            $updateStatusCode = Document::APPROVED[1];
            $updateStatusText = Document::APPROVED[0];
         }

        $document->update([
            'approved_status' => $updateStatusCode ,
            'approved_by' => $request->user()->id,
            'approved_at' => $request->get('createdAt'),
            'status' => $updateStatusText,
            'can_print' => $status,
            'message' => $request->get('message'),
            'updated_at' => Carbon::now()
        ]);

        $batch = Batch::whereBatchId($document->batch_id)->firstOrFail();

        // get the total remaining document that are yet to be process in a batch
        $checkDocApproval = Document::whereBatchId($batch->batch_id)->where('approved_status', Document::PENDING[1])->count();

        $batchStatus = "Partially Processed";
        if($batch->batch_max == $batch->number_of_document || $checkDocApproval == 0){
            $batchStatus = "Processed";
        }
        $batch->update([
            'approved_at' => Carbon::now(),
            'status' => $batchStatus,
            'updated_at' => Carbon::now()
        ]);

//        update([
//            'status' => $request->get('status'),
//            'approved_at' => $request->get('createdAt'),
//            'approved_status' => strtolower($request->get('status')) == "approved" ? 1 : 0
//        ]);

        return response([
            'message' => "Process Successfully Updated",
            'status' => $batch->status
        ], Response::HTTP_CREATED);
    }

    public function getDocumentByApproval(Document $document){
        return new DocumentResource($document);
    }

    public function getDocumentById($document){

        $document = ApprovedDocument::collection( Document::where('document_id', $document)->where('approved_status', '!=', Document::PENDING[1])->get());
        return $document;
    }

    public function getDocumentLike($document){

        $document = DB::table('documents')
            ->where('document_id', 'like', "%{$document}%")
            ->get();
        return DocumentResource::collection($document);

    }

    public function AllApprovedDocument(){

        $document = Document::all()->reject(function ($document) {
            return $document->set_for_approval_status == null;
        })
            ->filter(function ($document) {
                return $document->approved_status == Document::APPROVED[1];
            });

        $approvedDocument = ApprovedDocument::collection($document);
        return $approvedDocument;
    }

    public function AllDeniedDocument(){
        $document = Document::all()->reject(function ($document) {
            return $document->set_for_approval_status == null;
        })
            ->filter(function ($document) {
                return $document->approved_status == Document::DECLINED[1];
            });

        $deniedDocument = DeniedDocument::collection($document);
        return $deniedDocument;

    }

    public function documentGraph(){
        $documentCreated =  Document::thisYear()
            ->selectRaw(DB::raw("MONTHNAME(created_at) as day, count(*) as total"))
            ->groupBy('day')
            ->pluck('day', 'total');

        $documentApproved =  Document::ApprovedThisYear()
            ->selectRaw(DB::raw("DAYNAME(created_at) as day, count(*) as total"))
            ->groupBy(DB::raw('DAYNAME(created_at) DESC'))
            ->get();

        return [
            'created' => $documentCreated,
            'approved' => $documentApproved
        ];
    }
}
