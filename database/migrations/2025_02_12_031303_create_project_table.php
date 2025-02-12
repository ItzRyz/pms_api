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
        Schema::create('projecthd', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('statusid')->constrained('msstatus', 'id');
            $table->foreignId('categoryid')->constrained('mscategory', 'id');
            $table->foreignId('ownerid')->constrained('msuser', 'id');
            $table->timestamps();
        });

        Schema::create('projectteam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectid')->constrained('projecthd', 'id');
            $table->foreignId('userid')->constrained('msuser', 'id');
            $table->enum('access', ["reader", 'editor']);
            $table->timestamps();
        });

        Schema::create('projectsection', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectid')->constrained('projecthd', 'id');
            $table->string('sectionnm');
            $table->integer('sectionseq');
            $table->timestamps();
        });

        Schema::create('projecttask', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectid')->constrained('projecthd', 'id');
            $table->foreignId('sectionid')->constrained('projectsection', 'id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('assignedto');
            $table->date('startdate');
            $table->date('enddate');
            $table->foreignId('statusid')->constrained('msstatus', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projecthd');
        Schema::dropIfExists('projectteam');
        Schema::dropIfExists('projectsection');
        Schema::dropIfExists('projecttask');
    }
};
