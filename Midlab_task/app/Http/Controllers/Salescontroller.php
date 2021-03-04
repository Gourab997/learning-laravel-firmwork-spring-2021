<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\Ecommerce_channel;
use App\Models\Social_media_channel;
use App\Models\Physical_store_channel;
use App\Http\Requests\SalesRequest;

use PDF;
class Salescontroller extends Controller
{  public function index(Request $req){
    if($req->session()->has('salesname')){
        return view('sales.index' );
       }else{
           $req->session()->flash('msg','invalid request');
           return redirect('/login');
       }
}
public function sales_log(SalesRequest $req){
    $sales = new sales();
    $sales->Custome_name = $req->Custome_name;
    $sales->phone     = $req->phone;
    $sales->address     = $req->address;
    $sales->product_id = $req->product_id;
    $sales->product_name    = $req->product_name;
    $sales->unit_price  = $req->unit_price;
    $sales->quantity = $req->quantity;
    $sales->total_price = $req->total_price;
    $sales->pay_type = $req->pay_type;
    $sales->date_sold = now();
    $sales->status = "sold";
 
 
    $sales->save();
     return redirect('/system/sales/physicalstore');
}
public function physicalStore()
    {
        $data1 = Physical_store_channel::whereDate('created_at', today())->get();
        $date = \Carbon\Carbon::today()->subDays(7);
        $data2 = Physical_store_channel::where('created_at', '>=', $date)->get();
        $maxvaue = Physical_store_channel::max('total_price');
        $data3 = Physical_store_channel::where('total_price',$maxvaue)->get();
        $data4 = Physical_store_channel::avg('total_price');
   

    return view('sales.physical_store',['data1'=>$data1,'data2'=>$data2,'data3'=>$data3,'data4'=>$data4]);
    }
    
    public function mediaLog()
    {
        $data1 = Social_media_channel::whereDate('created_at', today())->get();
        $date = \Carbon\Carbon::today()->subDays(7);
        $data2 = Social_media_channel::where('created_at', '>=', $date)->get();
        return \view('superadmin.mediaLog.manage',['data1'=>$data1,'data2'=>$data2]);
    }

    public function ecommerceLog()
    {
        $data1 = Ecommerce_channel::whereDate('created_at', today())->get();
        $date = \Carbon\Carbon::today()->subDays(7);
        $data2 = Ecommerce_channel::where('created_at', '>=', $date)->get();
        return \view('superadmin.ecommerceLog.manage',['data1'=>$data1,'data2'=>$data2]);
    }

    public function salesLog()
    {
       
        return \view('superadmin.physicalStore.productSell');
    }

    public function salesLogData(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:30|min:3',
            'address' => 'required|max:50|min:3',
            'phone' => 'required|min:11|max:15',
            'product_id' => 'required',
            'product_name' => 'required',
            'unit_prics' => 'required|min:0',
            'quantity' => 'required|max:20|min:0',
            'total_price' => 'required|min:0',
            'payment_type' => 'required|max:5',
            'status' => 'required',
        ]);
        $data = new Physical_store_channel();

        $data->customer_name = $request->customer_name;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->product_id = $request->product_id;
        $data->product_name = $request->product_name;
        $data->unit_prics = $request->unit_prics;
        $data->quantity = $request->quantity;
        $data->total_price = $request->total_price;
        $data->payment_type = $request->payment_type;
        $data->status = $request->status;
        $data->save();
         return \back()->with('success','Payement Successfully Done');
    }

    public function uploadData()
    {
        return \view('superadmin.physicalStore.upload');
    }

    public function salesLogDetails()
    {
        $physicalStore = Physical_store_channel::where('status','=','sold')->get();
        return view('superadmin.physicalStore.salesLog')->with('Physicalstore', $physicalStore);
    }

    public function soldlog()
    {
        $physicalStore = Physical_store_channel::all();
        return view('superadmin.soldtable')->with('store', $physicalStore);
    }
    public function download()
    {
        $data = Physical_store_channel::all();
        view()->share('Sales', $data);
        $pdf =  Pdf::loadView('superadmin.pdf_share', $data);
        return $pdf->download('pdf_file.pdf');
    }
    public function downloadSoldProduct()
    {
        $data = Physical_store_channel::where('status','=','sold')->get();
        view()->share('Sales', $data);
        $pdf = PDF::loadView('superadmin.pdf_sold_product', $data);
        return $pdf->download('pdf_sold_file.pdf');
    }

    public function downloadPendingProduct()
    {
        $data = Physical_store_channel::where('status','=','unsold')->get();
        view()->share('Sales', $data);
        $pdf = PDF::loadView('superadmin.pdf_pending_product', $data);
        return $pdf->download('pdf_pending_file.pdf');
    }
}

