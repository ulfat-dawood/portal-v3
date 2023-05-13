<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("CLIN_APPT_SLOT_ID")->nullable();
            $table->bigInteger("package_id")->nullable();
            $table->integer("quantity")->nullable();
            $table->string("slot_day")->nullable();
            $table->string("slot_time")->nullable();
            $table->bigInteger("DOCTOR_ID")->nullable();
            $table->string("DOCTOR_NAME_1")->nullable();
            $table->string("DOCTOR_NAME_2")->nullable();
            $table->string("DOCTOR_NAME_3")->nullable();
            $table->string("DOCTOR_NAME_FAMILY")->nullable();
            $table->string("EXAM_PRICE")->nullable();
            $table->string("discount_percent")->nullable();
            $table->string("DISCOUNT_CASH")->nullable();
            $table->string("DISCOUNT_CODE")->nullable();
            $table->string("SEX")->nullable();
            $table->bigInteger("CLINIC_ID")->nullable();
            $table->string("CLINIC_NAME")->nullable();
            $table->bigInteger("CENTER_ID")->nullable();
            $table->string("CENTER_NAME")->nullable();
            $table->string("ADDRESS")->nullable();
            $table->string("CENTER_LAT")->nullable();
            $table->string("CENTER_LONG")->nullable();
            $table->string("LOGO")->nullable();
            $table->bigInteger("HOSPITAL_ID")->nullable();
            $table->string("HOSPITAL_NAME")->nullable();
            $table->bigInteger("APPT_TYPE_ID")->nullable();
            $table->string("PORTAL_DISCOUNT")->nullable();
            $table->string("payOnArrival")->nullable();
            $table->string("firstName")->nullable();
            $table->string("mobile")->nullable();
            $table->string("slot")->nullable();
            $table->string("accountId")->nullable();
            $table->string("patient_id")->nullable();
            $table->string("location_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
