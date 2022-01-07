<?php

namespace App\Console\Commands;

use App\Services\StreamUpdateService;
use Illuminate\Console\Command;

class StreamUpdateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'stream:update';

    /**
     * @var string
     */
    protected $description = 'Retrieving the top 1000 of twitch live streams';

    protected StreamUpdateService $streamUpdateService;

    /**
     * @return void
     */
    public function __construct(StreamUpdateService $streamUpdateService)
    {
        parent::__construct();
        $this->streamUpdateService = $streamUpdateService;
    }

    public function handle(): int
    {
        $this->info('Updating top streams started..');

        $this->streamUpdateService->update();

        $this->info('Done');
        return 0;
    }
}
