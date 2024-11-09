<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FactorySummaryService;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CalculateFactorySummaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summaries:calculate-factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and save factory summaries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(protected FactorySummaryService $factorySummaryService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Calculating factory summaries...');
        $this->factorySummaryService->calculateAndSaveFactorySummary();
        $this->info('Factory summaries calculation completed.');

        return CommandAlias::SUCCESS;
    }
}
