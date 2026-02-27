<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class bookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::firstOrCreate([
            'isbn' => '978-3-16-148410-0',
        ], [
            'title' => 'Animal Farm',
            'author' => 'George Orwell',
            'description' => 'A satirical allegory of Soviet totalitarianism.',
            'total_stock' => 5,
            'available_stock' => 5,
            'category_id' => 1,
            'cover_image' => 'covers/animal_farm.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-0-7432-7356-5',
        ], [
            'title' => 'Weak Hero Class',
            'author' => 'Takumi',
            'description' => 'A story about a weak hero who becomes strong through perseverance.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/weakheroclass.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-4241-5325-0',
        ], [
            'title' => 'Stranger Things',
            'author' => 'Netflix',
            'description' => 'A story about a group of friends who uncover supernatural mysteries in their small town.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/strangerthings.jpeg',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-5',
        ], [
            'title' => 'Losser Life',
            'author' => 'someone',
            'description' => 'A story about a loser who becomes a winner.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/losserlife.jpeg',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-0',
        ], [
            'title' => 'The Manipulated',
            'author' => 'Eserel',
            'description' => 'A story about manipulator',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/themanipulated.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-1',
        ], [
            'title' => 'Can This Love Be Translated?',
            'author' => 'Eserel',
            'description' => 'A story about a love that transcends language barriers.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/canthislovebetranslated.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-2',
        ], [
            'title' => 'All of Us Are Dead',
            'author' => 'Netflix',
            'description' => 'A story about a group of students trapped in a school during a zombie outbreak.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/allofusaredead.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-3',
        ], [
            'title' => 'Lookism',
            'author' => 'Park Tae-jun',
            'description' => 'A story about a high school student who can switch between two bodies, one attractive and one unattractive.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/lookism.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-4',
        ], [
            'title' => 'Breaking Bad',
            'author' => 'Vince Gilligan',
            'description' => 'A story about a high school chemistry teacher who becomes a meth kingpin.',
            'total_stock' => 3,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/breakingbad.jfif',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-6',
        ], [
            'title' => 'Windbreaker',
            'author' => 'Yongseok Jo',
            'description' => 'A story about a high school student who becomes a professional athlete.',
            'total_stock' => 50,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/windbreaker.jpeg',
        ]);
        Book::firstOrCreate([
            'isbn' => '978-1-2345-6789-7',
        ], [
            'title' => 'How to Fight',
            'author' => 'park tae-jun',
            'description' => 'A story about a high school student who learns how to fight.',
            'total_stock' => 50,
            'available_stock' => 3,
            'category_id' => 3,
            'cover_image' => 'covers/howtofight.jpeg',
        ]);
    }
}
