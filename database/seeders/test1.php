Skip to content
Servers with PHP 8.2 are now available for provisioning via Laravel Forge.
LaravelLaravel
Prologue
Getting Started
Architecture Concepts
The Basics
Digging Deeper
Security
Database
Eloquent ORM
Getting Started
Relationships
Collections
Mutators / Casts
API Resources
Serialization
Factories
Testing
Packages
API Documentation
Laravel Vapor: experience extreme scale on a dedicated serverless platform for Laravel. Sign up now!.

VERSION

10.x

Search
Eloquent: Factories
Introduction
Defining Model Factories
Generating Factories
Factory States
Factory Callbacks
Creating Models Using Factories
Instantiating Models
Persisting Models
Sequences
Factory Relationships
Has Many Relationships
Belongs To Relationships
Many To Many Relationships
Polymorphic Relationships
Defining Relationships Within Factories
Recycling An Existing Model For Relationships
Introduction
When testing your application or seeding your database, you may need to insert a few records into your database. Instead of manually specifying the value of each column, Laravel allows you to define a set of default attributes for each of your Eloquent models using model factories.

To see an example of how to write a factory, take a look at the database/factories/UserFactory.php file in your application. This factory is included with all new Laravel applications and contains the following factory definition:

namespace Database\Factories;
 
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}

As you can see, in their most basic form, factories are classes that extend Laravel's base factory class and define a definition method. The definition method returns the default set of attribute values that should be applied when creating a model using the factory.

Via the fake helper, factories have access to the Faker PHP library, which allows you to conveniently generate various kinds of random data for testing and seeding.


You can set your application's Faker locale by adding a faker_locale option to your config/app.php configuration file.

Defining Model Factories
Generating Factories
To create a factory, execute the make:factory Artisan command:

php artisan make:factory PostFactory

The new factory class will be placed in your database/factories directory.

Model & Factory Discovery Conventions
Once you have defined your factories, you may use the static factory method provided to your models by the Illuminate\Database\Eloquent\Factories\HasFactory trait in order to instantiate a factory instance for that model.

The HasFactory trait's factory method will use conventions to determine the proper factory for the model the trait is assigned to. Specifically, the method will look for a factory in the Database\Factories namespace that has a class name matching the model name and is suffixed with Factory. If these conventions do not apply to your particular application or factory, you may overwrite the newFactory method on your model to return an instance of the model's corresponding factory directly:

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Administration\FlightFactory;
 
/**
 * Create a new factory instance for the model.
 */
protected static function newFactory(): Factory
{
    return FlightFactory::new();
}

Then, define a model property on the corresponding factory:

use App\Administration\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
 
class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;
}

Factory States
State manipulation methods allow you to define discrete modifications that can be applied to your model factories in any combination. For example, your Database\Factories\UserFactory factory might contain a suspended state method that modifies one of its default attribute values.

State transformation methods typically call the state method provided by Laravel's base factory class. The state method accepts a closure which will receive the array of raw attributes defined for the factory and should return an array of attributes to modify:

use Illuminate\Database\Eloquent\Factories\Factory;
 
/**
 * Indicate that the user is suspended.
 */
public function suspended(): Factory
{
    return $this->state(function (array $attributes) {
        return [
            'account_status' => 'suspended',
        ];
    });
}

"Trashed" State
If your Eloquent model can be soft deleted, you may invoke the built-in trashed state method to indicate that the created model should already be "soft deleted". You do not need to manually define the trashed state as it is automatically available to all factories:

use App\Models\User;
 
$user = User::factory()->trashed()->create();

Factory Callbacks
Factory callbacks are registered using the afterMaking and afterCreating methods and allow you to perform additional tasks after making or creating a model. You should register these callbacks by defining a configure method on your factory class. This method will be automatically called by Laravel when the factory is instantiated:

namespace Database\Factories;
 
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
 
class UserFactory extends Factory
{
    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (User $user) {
            // ...
        })->afterCreating(function (User $user) {
            // ...
        });
    }
 
    // ...
}

Creating Models Using Factories
Instantiating Models
Once you have defined your factories, you may use the static factory method provided to your models by the Illuminate\Database\Eloquent\Factories\HasFactory trait in order to instantiate a factory instance for that model. Let's take a look at a few examples of creating models. First, we'll use the make method to create models without persisting them to the database:

use App\Models\User;
 
$user = User::factory()->make();

You may create a collection of many models using the count method:

$users = User::factory()->count(3)->make();

Applying States
You may also apply any of your states to the models. If you would like to apply multiple state transformations to the models, you may simply call the state transformation methods directly:

$users = User::factory()->count(5)->suspended()->make();

Overriding Attributes
If you would like to override some of the default values of your models, you may pass an array of values to the make method. Only the specified attributes will be replaced while the rest of the attributes remain set to their default values as specified by the factory:

$user = User::factory()->make([
    'name' => 'Abigail Otwell',
]);

Alternatively, the state method may be called directly on the factory instance to perform an inline state transformation:

$user = User::factory()->state([
    'name' => 'Abigail Otwell',
])->make();


Mass assignment protection is automatically disabled when creating models using factories.

Persisting Models
The create method instantiates model instances and persists them to the database using Eloquent's save method:

use App\Models\User;
 
// Create a single App\Models\User instance...
$user = User::factory()->create();
 
// Create three App\Models\User instances...
$users = User::factory()->count(3)->create();

You may override the factory's default model attributes by passing an array of attributes to the create method:

$user = User::factory()->create([
    'name' => 'Abigail',
]);

Sequences
Sometimes you may wish to alternate the value of a given model attribute for each created model. You may accomplish this by defining a state transformation as a sequence. For example, you may wish to alternate the value of an admin column between Y and N for each created user:

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
 
$users = User::factory()
                ->count(10)
                ->state(new Sequence(
                    ['admin' => 'Y'],
                    ['admin' => 'N'],
                ))
                ->create();

In this example, five users will be created with an admin value of Y and five users will be created with an admin value of N.

If necessary, you may include a closure as a sequence value. The closure will be invoked each time the sequence needs a new value:

use Illuminate\Database\Eloquent\Factories\Sequence;
 
$users = User::factory()
                ->count(10)
                ->state(new Sequence(
                    fn (Sequence $sequence) => ['role' => UserRoles::all()->random()],
                ))
                ->create();

Within a sequence closure, you may access the $index or $count properties on the sequence instance that is injected into the closure. The $index property contains the number of iterations through the sequence that have occurred thus far, while the $count property contains the total number of times the sequence will be invoked:

$users = User::factory()
                ->count(10)
                ->sequence(fn (Sequence $sequence) => ['name' => 'Name '.$sequence->index])
                ->create();

For convenience, sequences may also be applied using the sequence method, which simply invokes the state method internally. The sequence method accepts a closure or arrays of sequenced attributes:

$users = User::factory()
                ->count(2)
                ->sequence(
                    ['name' => 'First User'],
                    ['name' => 'Second User'],
                )
                ->create();

Factory Relationships
Has Many Relationships
Next, let's explore building Eloquent model relationships using Laravel's fluent factory methods. First, let's assume our application has an App\Models\User model and an App\Models\Post model. Also, let's assume that the User model defines a hasMany relationship with Post. We can create a user that has three posts using the has method provided by the Laravel's factories. The has method accepts a factory instance:

use App\Models\Post;
use App\Models\User;
 
$user = User::factory()
            ->has(Post::factory()->count(3))
            ->create();

By convention, when passing a Post model to the has method, Laravel will assume that the User model must have a posts method that defines the relationship. If necessary, you may explicitly specify the name of the relationship that you would like to manipulate:

$user = User::factory()
            ->has(Post::factory()->count(3), 'posts')
            ->create();

Of course, you may perform state manipulations on the related models. In addition, you may pass a closure based state transformation if your state change requires access to the parent model:

$user = User::factory()
            ->has(
                Post::factory()
                        ->count(3)
                        ->state(function (array $attributes, User $user) {
                            return ['user_type' => $user->type];
                        })
            )
            ->create();

Using Magic Methods
For convenience, you may use Laravel's magic factory relationship methods to build relationships. For example, the following example will use convention to determine that the related models should be created via a posts relationship method on the User model:

$user = User::factory()
            ->hasPosts(3)
            ->create();

When using magic methods to create factory relationships, you may pass an array of attributes to override on the related models:

$user = User::factory()
            ->hasPosts(3, [
                'published' => false,
            ])
            ->create();

You may provide a closure based state transformation if your state change requires access to the parent model:

$user = User::factory()
            ->hasPosts(3, function (array $attributes, User $user) {
                return ['user_type' => $user->type];
            })
            ->create();

Belongs To Relationships
Now that we have explored how to build "has many" relationships using factories, let's explore the inverse of the relationship. The for method may be used to define the parent model that factory created models belong to. For example, we can create three App\Models\Post model instances that belong to a single user:

use App\Models\Post;
use App\Models\User;
 
$posts = Post::factory()
            ->count(3)
            ->for(User::factory()->state([
                'name' => 'Jessica Archer',
            ]))
            ->create();

If you already have a parent model instance that should be associated with the models you are creating, you may pass the model instance to the for method:

$user = User::factory()->create();
 
$posts = Post::factory()
            ->count(3)
            ->for($user)
            ->create();

Using Magic Methods
For convenience, you may use Laravel's magic factory relationship methods to define "belongs to" relationships. For example, the following example will use convention to determine that the three posts should belong to the user relationship on the Post model:

$posts = Post::factory()
            ->count(3)
            ->forUser([
                'name' => 'Jessica Archer',
            ])
            ->create();

Many To Many Relationships
Like has many relationships, "many to many" relationships may be created using the has method:

use App\Models\Role;
use App\Models\User;
 
$user = User::factory()
            ->has(Role::factory()->count(3))
            ->create();

Pivot Table Attributes
If you need to define attributes that should be set on the pivot / intermediate table linking the models, you may use the hasAttached method. This method accepts an array of pivot table attribute names and values as its second argument:

use App\Models\Role;
use App\Models\User;
 
$user = User::factory()
            ->hasAttached(
                Role::factory()->count(3),
                ['active' => true]
            )
            ->create();

You may provide a closure based state transformation if your state change requires access to the related model:

$user = User::factory()
            ->hasAttached(
                Role::factory()
                    ->count(3)
                    ->state(function (array $attributes, User $user) {
                        return ['name' => $user->name.' Role'];
                    }),
                ['active' => true]
            )
            ->create();

If you already have model instances that you would like to be attached to the models you are creating, you may pass the model instances to the hasAttached method. In this example, the same three roles will be attached to all three users:

$roles = Role::factory()->count(3)->create();
 
$user = User::factory()
            ->count(3)
            ->hasAttached($roles, ['active' => true])
            ->create();

Using Magic Methods
For convenience, you may use Laravel's magic factory relationship methods to define many to many relationships. For example, the following example will use convention to determine that the related models should be created via a roles relationship method on the User model:

$user = User::factory()
            ->hasRoles(1, [
                'name' => 'Editor'
            ])
            ->create();

Polymorphic Relationships
Polymorphic relationships may also be created using factories. Polymorphic "morph many" relationships are created in the same way as typical "has many" relationships. For example, if a App\Models\Post model has a morphMany relationship with a App\Models\Comment model:

use App\Models\Post;
 
$post = Post::factory()->hasComments(3)->create();

Morph To Relationships
Magic methods may not be used to create morphTo relationships. Instead, the for method must be used directly and the name of the relationship must be explicitly provided. For example, imagine that the Comment model has a commentable method that defines a morphTo relationship. In this situation, we may create three comments that belong to a single post by using the for method directly:

$comments = Comment::factory()->count(3)->for(
    Post::factory(), 'commentable'
)->create();

Polymorphic Many To Many Relationships
Polymorphic "many to many" (morphToMany / morphedByMany) relationships may be created just like non-polymorphic "many to many" relationships:

use App\Models\Tag;
use App\Models\Video;
 
$videos = Video::factory()
            ->hasAttached(
                Tag::factory()->count(3),
                ['public' => true]
            )
            ->create();

Of course, the magic has method may also be used to create polymorphic "many to many" relationships:

$videos = Video::factory()
            ->hasTags(3, ['public' => true])
            ->create();

Defining Relationships Within Factories
To define a relationship within your model factory, you will typically assign a new factory instance to the foreign key of the relationship. This is normally done for the "inverse" relationships such as belongsTo and morphTo relationships. For example, if you would like to create a new user when creating a post, you may do the following:

use App\Models\User;
 
/**
 * Define the model's default state.
 *
 * @return array<string, mixed>
 */
public function definition(): array
{
    return [
        'user_id' => User::factory(),
        'title' => fake()->title(),
        'content' => fake()->paragraph(),
    ];
}

If the relationship's columns depend on the factory that defines it you may assign a closure to an attribute. The closure will receive the factory's evaluated attribute array:

/**
 * Define the model's default state.
 *
 * @return array<string, mixed>
 */
public function definition(): array
{
    return [
        'user_id' => User::factory(),
        'user_type' => function (array $attributes) {
            return User::find($attributes['user_id'])->type;
        },
        'title' => fake()->title(),
        'content' => fake()->paragraph(),
    ];
}

Recycling An Existing Model For Relationships
If you have models that share a common relationship with another model, you may use the recycle method to ensure a single instance of the related model is recycled for all of the relationships created by the factory.

For example, imagine you have Airline, Flight, and Ticket models, where the ticket belongs to an airline and a flight, and the flight also belongs to an airline. When creating tickets, you will probably want the same airline for both the ticket and the flight, so you may pass an airline instance to the recycle method:

Ticket::factory()
    ->recycle(Airline::factory()->create())
    ->create();

You may find the recycle method particularly useful if you have models belonging to a common user or team.

The recycle method also accepts a collection of existing models. When a collection is provided to the recycle method, a random model from the collection will be chosen when the factory needs a model of that type:

Ticket::factory()
    ->recycle($airlines)
    ->create();

ads via Carbon
Your new development career awaits. Check out the latest listings.
ADS VIA CARBON
Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in most web projects.

Twitter
GitHub
Discord
YouTube
HIGHLIGHTS
Our Team
Release Notes
Getting Started
Routing
Blade Templates
Authentication
Authorization
Artisan Console
Database
Eloquent ORM
Testing
RESOURCES
Laravel Bootcamp
Laracasts
Laravel News
Laracon
Laracon AU
Laracon EU
Laracon India
Jobs
Forums
Trademark
PARTNERS
WebReinvent
Vehikl
Tighten
64 Robots
Active Logic
Byte 5
Curotec
Cyber-Duck
DevSquad
Jump24
Kirschbaum
ECOSYSTEM
Cashier
Dusk
Echo
Envoyer
Forge
Horizon
Nova
Octane
Sail
Sanctum
Scout
Spark
Telescope
Valet
Vapor
Laravel is a Trademark of Taylor Otwell. Copyright © 2011-2023 Laravel LLC.

Code highlighting provided by Torchlight

0