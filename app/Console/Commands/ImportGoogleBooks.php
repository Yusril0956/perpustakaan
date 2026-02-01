<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Http;


class ImportGoogleBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:import-google {query=computer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import books from Google Books API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = $this->argument('query');

        $category = Category::first();
        if (!$category) {
            $this->error('No category found.');
            return;
        }

        $response = Http::get(
            'https://www.googleapis.com/books/v1/volumes',
            [
                'q' => $query,
                'maxResults' => 40,
            ]
        );

        if (!$response->successful()) {
            $this->error('Failed to fetch data');
            return;
        }

        $items = $response->json('items', []);

        $count = 0;

        foreach ($items as $item) {
            $info = $item['volumeInfo'] ?? [];

            $isbn = collect($info['industryIdentifiers'] ?? [])
                ->firstWhere('type', 'ISBN_13')['identifier']
                ?? null;

            if ($isbn && Book::where('isbn', $isbn)->exists()) {
                continue;
            }

            Book::create([
                'category_id' => $category->id,
                'title' => $info['title'] ?? 'Unknown Title',
                'author' => $info['authors'][0] ?? 'Unknown Author',
                'isbn' => $isbn,
                'description' => $info['description'] ?? null,
                'cover_image' => $info['imageLinks']['thumbnail'] ?? null,
                'total_stock' => rand(1, 5),
                'available_stock' => rand(1, 5),
            ]);

            $count++;
        }

        $this->info("Imported {$count} books from Google Books.");
    }
}
