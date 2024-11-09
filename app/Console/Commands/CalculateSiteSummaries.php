<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SiteSummaryService;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CalculateSiteSummaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summaries:calculate-site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and save site summaries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(protected SiteSummaryService $siteSummaryService)
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
        $this->info('Calculating site summaries...');
        $this->siteSummaryService->calculateAndSaveSiteSummary();
        $this->info('Site summaries calculation completed.');

        return CommandAlias::SUCCESS;
    }
}
