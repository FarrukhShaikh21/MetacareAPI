<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MetacareController extends Controller
{
   public function getJobcardStatus(Request $request)
   {
    $p_jobcardno = $request->query('p_jobcardno'); 
    $data=DB::SELECT("Select 
 decode(J.JOBSTATUS,'RJ','Return','TL','Transfer','SW','Swap','WE','Estimation','WE2','Estimation',
                               'IS','Issuance','OK','QC','TT','Reassign(TT)','IN','Assign','RW','Review Warranty', 'DE','Deliverd',
                               'QCF','Reassign(QCF)','CO','Invoice','PNA','Reassign(PNA)','RS','Solution',
                               'RD','Delivery','TLG','Transfered 4 Log','RLG','Returned 4 Log','IP','Reassign(Log/Est.)',
                               'TIP','Pending Jobs Receive','TDP','Pending Jobs Receive',
                               'CP','Pending Jobs Return','DP','Pending Jobs Return', 'RDP','Pending Jobs Receive','RCP','Pending Jobs Receive',
                               'DAP','DAP','FD','CRO Handover','RP','Set Replacement',J.JOBSTATUS) JobcardStatus
From SRV_JobCard j
Where j.JobCardno = '$p_jobcardno'");
    if ($data==null)//if no data found then $data will be null
    {
        return response()->json([
            'JobcardStatus' => 'Jobcard doesnot exist.'
        ], 404);
    }
    else //else show all data
    {
    return response()->json($data);
    }
   }
}
