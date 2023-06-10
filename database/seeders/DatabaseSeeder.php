<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Coupon;
use App\Models\OldSlug;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            'Adventure stories', 'Classics', 'Crime', 'Fairy tales, fables, and folk tales', 'Fantasy',
            'Historical fiction', 'Horror', 'Humour and satire', 'Literary fiction', 'Mystery', 'Poetry', 'Plays',
            'Romance', 'Science fiction', 'Short stories', 'Thrillers', 'War', 'Women’s fiction', 'Young adult',
            'Autobiography and memoir', 'Biography', 'Essays', 'Non-fiction novel', 'Self-help'
        ];

        $categories_slugs=[
            'adventure-stories', 'classics', 'crime', 'fairy-tales-fables-and-folk-tales', 'fantasy', 'historical-fiction',
            'horror', 'humour-and-satire', 'literary-fiction', 'mystery', 'poetry', 'plays', 'romance', 'science-fiction',
            'short-stories', 'thrillers', 'war', 'womens-fiction', 'young-adult', 'autobiography-and-memoir', 'biography',
            'essays', 'non-fiction-novel', 'self-help'
        ];

        $covers=['books/ToKillAMockingbirdBook.jpg', 'books/1984.jpg', 'books/HarryPotterAndThePhilosophersStone.jpg', 'books/TheLordOfTheRings.jpg',
            'books/TheGreatGatsbyBook.jpg', 'books/Fahrenheit451.jpg', 'books/TheLionTheWitchAndTheWardrobe.jpg', 'books/AliceInWonderland.jpg'];

        $titles=['To Kill a Mockingbird', '1984', "Harry Potter and the Philosopher's Stone", 'The Lord Of The Rings',
            'The Great Gatsby', 'Fahrenheit451', 'The Lion, the Witch and the Wardrobe', 'Alice in Wonderland'];

        $slugs=['to-kill-a-mockingbird', '1984', 'harry-potter-and-the-philosophers-stone', 'the-lord-of-rings',
            'the-great-gatsby', 'fahrenheit-451', 'the-lion-the-witch-and-the-wardrobe', 'alice-in-wonderland'];

        $authors=['Harper Lee', 'George Orwell', 'Rowling J.K.', 'J.R.R. Tolkien', 'F. Scott Fitzgerald', 'Ray Bradbury',
            'C. S. Lewis', 'Lewis Carroll'];

        $publishers=['Grand Central Publishing', 'Signet Classic', 'Bloomsbury', 'William Morrow Paperbacks', "Charles Scribner's Sons",
            'Simon & Schuster', 'HarperCollins', 'The Clarendon Press'];

        $categoriesBooks=[6, 6, 5, 5, 10, 9, 2, 9];

        $descriptions=['The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it, To Kill A Mockingbird became both an instant bestseller and a critical success when it was first published in 1960. It went on to win the Pulitzer Prize in 1961 and was later made into an Academy Award-winning film, also a classic.
Compassionate, dramatic, and deeply moving, To Kill A Mockingbird takes readers to the roots of human behavior - to innocence and experience, kindness and cruelty, love and hatred, humor and pathos. Now with over 18 million copies in print and translated into forty languages, this regional story by a young Alabama woman claims universal appeal. Harper Lee always considered her book to be a simple love story. Today it is regarded as a masterpiece of American literature.',
            'Winston Smith toes the Party line, rewriting history to satisfy the demands of the Ministry of Truth. With each lie he writes, Winston grows to hate the Party that seeks power for its own sake and persecutes those who dare to commit thought crimes. But as he starts to think for himself, Winston can’t escape the fact that Big Brother is always watching...
            A startling and haunting novel, 1984 creates an imaginary world that is completely convincing from start to finish. No one can deny the novel’s hold on the imaginations of whole generations, or the power of its admonitions—a power that seems to grow, not lessen, with the passage of time.',
            "Galloping gargoyles ... 2022 is the silver anniversary of J.K. Rowling's magical classic Harry Potter and the Philosopher's Stone! The boy wizard Harry Potter has been casting a spell over young readers and their families ever since 1997. Now the first book in this unmissable series celebrates 25 years in print! The paperback edition of the tale that introduced us to Harry, Ron and Hermione has been updated and dressed in silver to mark the occasion. It's time to take the magical journey of a lifetime ... Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry's eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin! These editions of the classic and internationally bestselling Harry Potter series feature thrilling jacket artwork by award-winning illustrator Jonny Duddle. They are the perfect starting point for anyone who's ready to lose themselves in the greatest children's story of all time. Available for one year only, Harry's first adventure - Harry Potter and the Philosopher's Stone - has been emblazoned in silver and refreshed with extra content including a new Hogwarts crest illustration and Q&A with Jonny Duddle, plus fun facts exploring the origins of names such as Albus Dumbledore, Hedwig and other favourite characters.",
            "In ancient times the Rings of Power were crafted by the Elven-smiths, and Sauron, the Dark Lord, forged the One Ring, filling it with his own power so that he could rule all others. But the One Ring was taken from him, and though he sought it throughout Middle-earth, it remained lost to him. After many ages it fell by chance into the hands of the hobbit Bilbo Baggins.
            From Sauron's fastness in the Dark Tower of Mordor, his power spread far and wide. Sauron gathered all the Great Rings, but always he searched for the One Ring that would complete his dominion.
            When Bilbo reached his eleventy-first birthday he disappeared, bequeathing to his young cousin Frodo the Ruling Ring and a perilous quest: to journey across Middle-earth, deep into the shadow of the Dark Lord, and destroy the Ring by casting it into the Cracks of Doom.
            The Lord of the Rings tells of the great quest undertaken by Frodo and the Fellowship of the Ring: Gandalf the Wizard; the hobbits Merry, Pippin, and Sam; Gimli the Dwarf; Legolas the Elf; Boromir of Gondor; and a tall, mysterious stranger called Strider.",
            "The Great Gatsby is a 1925 novel by American writer F. Scott Fitzgerald. Set in the Jazz Age on Long Island, the novel depicts narrator Nick Carraway's interactions with mysterious millionaire Jay Gatsby and Gatsby's obsession to reunite with his former lover, Daisy Buchanan.
            A youthful romance Fitzgerald had with socialite Ginevra King, and the riotous parties he attended on Long Island's North Shore in 1922 inspired the novel. Following a move to the French Riviera, he completed a rough draft in 1924. He submitted the draft to editor Maxwell Perkins, who persuaded Fitzgerald to revise the work over the following winter. After his revisions, Fitzgerald was satisfied with the text, but remained ambivalent about the book's title and considered several alternatives. The final title he desired was Under the Red, White, and Blue. Painter Francis Cugat's final cover design impressed Fitzgerald who incorporated a visual element from the art into the novel.
            Gatsby continues to attract popular and scholarly attention. The novel was most recently adapted to film in 2013 by director Baz Luhrmann, while contemporary scholars emphasize the novel's treatment of social class, inherited wealth compared to those who are self-made, race, environmentalism, and its cynical attitude towards the American dream. The Great Gatsby is widely considered to be a literary masterpiece and a contender for the title of the Great American Novel.",
            "Guy Montag is a fireman. His job is to destroy the most illegal of commodities, the printed book, along with the houses in which they are hidden. Montag never questions the destruction and ruin his actions produce, returning each day to his bland life and wife, Mildred, who spends all day with her television “family.” But when he meets an eccentric young neighbor, Clarisse, who introduces him to a past where people didn’t live in fear and to a present where one sees the world through the ideas in books instead of the mindless chatter of television, Montag begins to question everything he has ever known.",
            "Four adventurous siblings—Peter, Susan, Edmund, and Lucy Pevensie—step through a wardrobe door and into the land of Narnia, a land frozen in eternal winter and enslaved by the power of the White Witch. But when almost all hope is lost, the return of the Great Lion, Aslan, signals a great change . . . and a great sacrifice.
            Open the door and enter a new world! The Lion, the Witch and the Wardrobe is the second book in C. S. Lewis's classic fantasy series, which has been captivating readers of all ages with a magical land and unforgettable characters for over sixty years.
            This is a stand-alone read, but if you would like to discover more about Narnia, pick up The Horse and His Boy, the third book in The Chronicles of Narnia.",
            "This Beautiful edition contains complete original black and white illustrations by Sir John Tenniel.
            Alice in Wonderland is an 1865 novel by English author Lewis Carroll. It tells of a young girl named Alice, who falls through a rabbit hole into a subterranean fantasy world populated by peculiar, anthropomorphic creatures. It is considered to be one of the best examples of the literary nonsense genre. The tale plays with logic, giving the story lasting popularity with adults as well as with children.
            One of the best-known and most popular works of English-language fiction, its narrative, structure, characters and imagery have been enormously influential in popular culture and literature, especially in the fantasy genre. The work has never been out of print and has been translated into at least 97 languages. Its ongoing legacy encompasses many adaptations for stage, screen, radio, art, ballet, theme parks, board games and video games."];

        $prices=[24.99, 13.39, 13.49, 24.99, 12.91, 16.49, 14.99, 11.69];

        $dates=['1988-10-11', '1961-01-01', '2014-09-01', '2012-08-14', '1925-04-10', '2012-01-01', '2008-01-02', '1865-11-01'];

        $pages=[384, 328, 342, 1216, 110, 176, 208, 101];

        $dimensions=['6.69 x 4.13 x 0.98 inches', '4.19 x 0.85 x 7.5 inches', '5.08 x 0.91 x 7.76 inches', '5.5 x 1.75 x 8.25 inches',
            '6 x 0.25 x 9 inches', '5.5 x 1.2 x 8.44 inches', '5.2 x 0.47 x 7.68 inches', '6 x 0.23 x 9 inches'];

        for ($i = 0; $i < count($categories) ;$i++) {
           Category::factory()->create([
               'name' => $categories[$i],
               'slug' => $categories_slugs[$i]
            ]);
        }

        for ($i = 0; $i < count($titles) ;$i++){
            Book::factory()->create([
                'cover' => $covers[$i],
                'title' => $titles[$i],
                'slug' => $slugs[$i],
                'author' => $authors[$i],
                'publisher' => $publishers[$i],
                'category_id' => $categoriesBooks[$i],
                'description' => $descriptions[$i],
                'price' => $prices[$i],
                'date' => $dates[$i],
                'pages' => $pages[$i],
                'dimensions' => $dimensions[$i],
                'languages' => 'English',
                'type' => 'Hardcover',
                'created_at' => '2023-02-' . implode([$i])
            ]);
        }

        Comment::factory()->create([
            'book_id' => 1,
            'body' => 'Great book!',
        ]);

        Coupon::factory()->create([
            'name' => 'Holiday Coupon',
            'code' => 'HOLIDAY-COUPON-2023',
            'type' => 'fixed',
            'value' => 20,
            'valid_from' => '2023-01-14',
            'valid_until' => '2025-12-12'
        ]);

        Coupon::factory()->create([
            'name' => 'Christmas Coupon',
            'code' => 'CHRISTMAS-COUPON-2023',
            'type' => 'percent_off',
            'percent_off' => 20,
            'valid_from' => '2023-01-14',
            'valid_until' => '2025-12-12'
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
            'password' => bcrypt('Admin1234!'),
            'avatar' => 'avatar4.png'
        ]);

        OldSlug::factory()->create([
            'slug' => 'old-slug',
            'book_id' => 1
        ]);

    }
}
