<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function paymentList(){
        $payments = Payment::all();
        return view('admin.payment.list', compact('payments'));
    }

    public function createPayment(Request $request){
        
        $request->validate([
            'paymentMethod' => 'required|string|max:255',
        ]);

        Payment::create([
            'payment_method' => $request->paymentMethod,
        ]);

        Alert::success('Success', 'Payment Method Created Successfully!');
        return back()->with(['createSuccess' => 'Payment Method Created Successfully!']);

    }

    public function deletePayment($id){
        Payment::findorFail($id)->delete();
        Alert::success('Payment Deleted', 'The payment has been deleted successfully!');
        return back();
    }

    public function editPayment($id){
        $payment = Payment::findOrFail($id);
        return view('admin.payment.edit', compact('payment'));
    }

    public function updatePayment(Request $request){
        $request->validate([
            'paymentMethod' => 'required|string|max:255',
        ]);

        Payment::where('id', $request->paymentId)->update([
            'payment_method' => $request->paymentMethod,
        ]);

        Alert::success('Payment Updated', 'The payment has been updated successfully!');
        return redirect()->route('payment#list');
    }

    
}
