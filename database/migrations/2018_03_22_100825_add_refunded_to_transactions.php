<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Transaction;

class AddRefundedToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('type', 4);
            $table->string('receipt', 8);
            $table->integer('maxItemNo');
            $table->boolean('refunded')->default(0);
        });
        foreach (Transaction::all() as $transaction) {
            $order = json_decode($transaction->data);
            $transaction->type = $order->transactionType;
            $transaction->receipt = $order->receipt;
            $maxItem = 0;
            foreach ($order->lineItems as $item) {
                if ($item->itemNo > $maxItem) {
                    $maxItem = $item->itemNo;
                }
            }
            $transaction->maxItemNo = $maxItem;
            $transaction->save();
        }
        foreach (Transaction::where('type', 'RFND')->get() as $refundTransaction) {
            foreach (Transaction::where('receipt', $refundTransaction->receipt)->where('type', '!=', 'RFND')->get() as $transaction) {
                $transaction->refunded = true;
                $transaction->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('receipt');
            $table->dropColumn('maxItemNo');
            $table->dropColumn('refunded');
        });
    }
}
