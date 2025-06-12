<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductInterestToQuoteRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->json('product_interest')->nullable()->after('company');
        });
    }

    public function down()
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->dropColumn('product_interest');
        });
    }
}
