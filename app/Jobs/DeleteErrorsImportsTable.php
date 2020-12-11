<?php

namespace App\Jobs;

use App\Entities\ErrorImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteErrorsImportsTable implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
    * Execute the job.
    *
    * @return void
    */
    public function handle(): void
    {
        ErrorImport::truncate();
    }
}
