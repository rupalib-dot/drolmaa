<?php

namespace App\Http\Controllers\CommonController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Administrator;
use App\Model\Company;
use App\Model\Business;
use App\Helpers\CommonHelper; 
use BusinessAccount;
use App\Helpers\ExcelHelper; 
use App\Model\Partner;
use App\Model\ContactEnq;
use App\Model\Country;
use App\Model\State;
use ZipArchive;
use App\Model\BussInvoice;
use App\Model\BankDetails;
use App\Model\BussInvoiceDtl; 
use App\Model\Miscellaneous;
use App\Model\Invoice;
use App\Model\Subscription;
use PDF;
use Response;
use Excel;
use DB; 

class CommonTaskController extends Controller
{
    public function __construct()
    {
        $this->Company          = new Company;
        $this->Business         = new Business; 
        $this->Partner 			= new Partner;
		$this->Country 			= new Country;
		$this->Invoice			= new Invoice;
		$this->BussInvoice		= new BussInvoice;
		$this->BankDetails		= new BankDetails;
		$this->BussInvoiceDtl	= new BussInvoiceDtl;  
		$this->State 			= new State;
		$this->Miscellaneous 	= new Miscellaneous;
        $this->Subscription 	= new Subscription; 
        $this->CommonHelper     = new CommonHelper;
		$this->ExcelHelper 			= new ExcelHelper;
        $this->ContactEnq = new ContactEnq;
    }

    public function DelRec(Request $request)
    {
        $lRecIdNo   = base64_decode($request['lRecIdNo']);
        $sTblName   = base64_decode($request['sTblName']);
        $sFldName   = base64_decode($request['sFldName']);

        $oGetRec    = DB::table($sTblName)->Where($sFldName,$lRecIdNo)->first();
        if(isset($oGetRec) && !empty($oGetRec->$sFldName))
        {
            $aValue = array(
                "nDel_Status"   => config('constant.DEL_STATUS.DELETED'),
            );
            DB::table($sTblName)->Where($sFldName,$lRecIdNo)->update($aValue);
            if($sTblName == 'mst_cntry'){
                $saValue = array(
                    "nDel_Status"   => config('constant.DEL_STATUS.DELETED'),
                );
                DB::table('mst_state')->Where('lCntry_IdNo',$lRecIdNo)->update($saValue);
            }
            return redirect()->back()->with('Success', 'Record deleted successfully...');
        }
        else
        {
            return redirect()->back()->withInput($request->all())->with('Failed', 'Unauthorized access...');
        }
    }

    public function ChngStatus(Request $request)
    {
        $lRecIdNo = base64_decode($request['lRecIdNo']);
        $sTblName = base64_decode($request['sTblName']);
        $sFldName = base64_decode($request['sFldName']);
        $nStatus  = base64_decode($request['nStatus']);

        $oGetRec  = DB::table($sTblName)->Where($sFldName,$lRecIdNo)->first();
        if(isset($oGetRec) && !empty($oGetRec->$sFldName))
        {
            $aValue = array(
                "nBlk_UnBlk"   => $nStatus,
            );
            DB::table($sTblName)->Where($sFldName,$lRecIdNo)->update($aValue);
            if($sTblName == 'mst_cntry'){
                $saValue = array(
                    "nBlk_UnBlk"   => $nStatus,
                );
                DB::table('mst_state')->Where('lCntry_IdNo',$lRecIdNo)->update($saValue);
            }
            return redirect()->back()->with('Success', 'Status changed successfully...');
        }
        else
        {
            return redirect()->back()->withInput($request->all())->with('Failed', 'Unauthorized access...');
        }
    }

    public function FrgtPass()
    {
        $sTitle         = "Forgot Password";
        $aData          = compact('sTitle');
        return view('forgot_password',$aData);
    }

    public function VldtEmail(Request $request)
    {
        $rules = [
            'sUserEmail'      => 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
        ];
        
        $this->validate($request, $rules, config('constant.VLDT_MSG'));

        try
        {
            $yCompExist = $this->Company->IsEmailExist($request['sUserEmail'], $oGetUser);
            if($yCompExist)
            {
                $sEmailId   = $oGetUser->sComp_Email;
                $sUserName  = $oGetUser->sPrsn_Name;
                $sTkn       = $this->CommonHelper->RndmStrg(50);
                $aTknArr    = $this->TknArr($sTkn);
                $nRow       = $this->Company->UpDtRecrd($aTknArr, $oGetUser->lComp_IdNo);
                $aEmailData = ['lRecIdNo' => $oGetUser->lComp_IdNo, 'sEmailId' => $sEmailId, 'sUserName' => $oGetUser->sPrsn_Name, 'sToken' => $sTkn];
            }
            else
            {
                $yBussExist = $this->Business->IsEmailExist($request['sUserEmail'], $oGetUser);
                if($yBussExist)
                {
                    $sEmailId   = $oGetUser->sEmail_Id;
                    $sUserName  = $oGetUser->sBuss_Name;
                    $sTkn       = $this->CommonHelper->RndmStrg(50);
                    $aTknArr    = $this->TknArr($sTkn);
                    $nRow       = $this->Business->UpDtRecrd($aTknArr, $oGetUser->lBuss_IdNo);
                    $aEmailData = ['lRecIdNo' => $oGetUser->lBuss_IdNo, 'sEmailId' => $sEmailId, 'sUserName' => $oGetUser->sBuss_Name, 'sToken' => $sTkn];
                }
            }
            if(isset($aEmailData))
            {
                $this->CommonHelper->SendEmail($sEmailId, $sUserName, 'forgot_password', 'FlipBooks - Password Reset!', $aEmailData);
                return redirect('/')->with('Success', 'Password reset link sent on your email..');
            }
            else
            {
                return redirect()->back()->withInput($request->all())->with('Failed', 'We could not found any account with that email..');
            }
        }
        catch(\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->withInput($request->all())->with('Failed', $e->getMessage()." on line ".$e->getLine());
        }
    }

    public function TknArr($sTkn)
    {
        $aCmnArr = array(
            "sRst_Token" => $sTkn,
        );
        return $aCmnArr;
    }

    public function RstPassFrm(Request $request)
    {
        try
        {
            $yLinkStatus = False;
            $sToken     = $request['sToken'];
            $sValid     = base64_decode($request['sValid']);
            if(empty($sToken) || empty($sValid))
            {
                return redirect('/')->withInput($request->all())->with('Failed', 'Unauthorized access..');
            }
            else
            {
                $dHrDiff = round((strtotime(date('Y-m-d H:i:d')) - strtotime($sValid))/3600, 1);
                if($dHrDiff > 1)
                {
                   return redirect('/')->withInput($request->all())->with('Failed', 'Reset password link expaired...'); 
                }
                else
                {
                    $yCompLink = $this->Company->IsTokenExist($sToken, $lCompIdNo);
                    if($yCompLink)
                    {
                        $yLinkStatus = True;
                    }
                    else
                    {
                        $yBussLink = $this->Business->IsTokenExist($sToken, $lBussIdNo);
                        if($yBussLink)
                        {
                            $yLinkStatus = True;
                        }
                    }
                }

                if(!$yLinkStatus)
                {
                    return redirect('/')->withInput($request->all())->with('Failed', 'This URL already used for rest passowrd...'); 
                }
                $sTitle   = "Reset Password";
                $aData    = compact('sTitle','sToken');
                return view('reset_password',$aData);
            }
        }
        catch(\Exception $e)
        {
            return redirect('')->withInput($request->all())->with('Failed', $e->getMessage()." on line ".$e->getLine());
        }
    }

    public function RstPassSave(Request $request)
    {
        $rules = [
            'sLgnPass'      => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'sCnfrmPass'    => 'required|required_with:sLgnPass|same:sLgnPass',
        ];
        
        $this->validate($request, $rules, config('constant.VLDT_MSG'));

        try
        {
            \DB::beginTransaction();
                $sToken    = $request['sToken'];
                $aPassArr  = $this->PassArr($request['sLgnPass']);
                $yCompLink = $this->Company->IsTokenExist($sToken, $lCompIdNo);
                if($yCompLink)
                {
                    $nRow           = $this->Company->UpDtRecrd($aPassArr, $lCompIdNo);
                }
                else
                {
                    $yBussLink = $this->Business->IsTokenExist($sToken, $lBussIdNo);
                    if($yBussLink)
                    {
                        $nRow           = $this->Business->UpDtRecrd($aPassArr, $lBussIdNo);
                    }
                }
            \DB::commit();
            if(isset($nRow) && $nRow > 0)
            {
                return redirect('')->with('Success', 'Password successfully changed...');
            }
            else
            {
                return redirect()->back()->withInput($request->all())->with('Failed', 'Password did not changed, Please try again...');
            }
        }
        catch(\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->withInput($request->all())->with('Failed', $e->getMessage()." on line ".$e->getLine());
        }
    }

    public function PassArr($sLgnPass)
    {
        $aHdArr = array(
            "sLgn_Pass"     => md5($sLgnPass),
            "sRst_Token"    => NULL,
        );
        return $aHdArr;
    }

    public function Download(Request $request,$type,$lBussInvIdNo)
	{ 
		$lBussInvIdNo = base64_decode($lBussInvIdNo);
		$lBussIdNo  = session('LUSER_IDNO');
        $ySubsExist = $this->Subscription->SubsExist($lBussIdNo);
        if(!$ySubsExist)
        {
        	return redirect('subscription/payment');
	    }

		try
        {
			$sTitle			= "Download Invoice";
			$oBussInv		= $this->BussInvoice->DtlBussInv($lBussInvIdNo);
			$aBussInvDtl	= $this->BussInvoiceDtl->BussInvDtl($lBussInvIdNo); 
			$aBankDtl		= $this->BankDetails->BankDtl($lBussInvIdNo); 
			$oInvDtl		= $this->Invoice->InvCatDtl($oBussInv->lCatg_IdNo);
			$oPrtnrDtl		= $this->Partner->RcrdDtl($oBussInv->lPrtnr_IdNo); 
			$sBussRcrd		= $this->Business->RcrdDtl(session('LUSER_IDNO'));
			$aData 			= compact('sTitle','oBussInv','aBussInvDtl','aBankDtl','sBussRcrd','oInvDtl','oPrtnrDtl'); 
            if($type == 'print'){
                return view('bussiness_panel.invoice_module.Viewold',$aData); 
            }else{  
                $pdf = PDF::loadView('bussiness_panel.invoice_module.Viewold', $aData); 
                return $pdf->download($oBussInv->sInv_No.'.pdf'); 
            } 
            
	    }
		catch(\Exception $e)
		{
			return redirect()->back()->withInput($request->all())->with('Failed', $e->getMessage()." on line ".$e->getLine());
		}
	}
    
    public function ContactUsSubmit(Request $request)
    {  
        try
        { 
            // \DB::beginTransaction(); 
            
            $aConArr = array(
                'first_name'            => $request['firstname'],
                'last_name'             => $request['lastname'],
                'mobile_Number'         => $request['mobileNumber'],
                'email_Address'         => $request['emailAddress'],
                'questions'             => $request['questions'], 
                'block_status'          => config('constant.STATUS.UNBLOCK'),
                'delete_status'         => config('constant.DEL_STATUS.UNDELETED'),
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ); 
            $oInsrtEnq = $this->ContactEnq->InsrtRecrd($aConArr);
            if($oInsrtEnq)
            { 
                return redirect()->back()->with('Success', 'Inquiry Submitted Successful...');
            }
            else
            {
                return redirect()->back()->with('Failed', 'Inquiry Not Submitted Successful...');
            }
 
            // \DB::commit(); 
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            \DB::rollback();
            return redirect()->back()->withInput($request->all())->with('Failed', $ex->getMessage()." on line ".$ex->getLine());
        }
    }
}