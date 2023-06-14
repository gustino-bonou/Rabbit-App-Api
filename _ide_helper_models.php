<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Adoption
 *
 * @property int $id
 * @property string $adoption_date
 * @property string $observation
 * @property int|null $adoption_mother
 * @property int|null $whelping_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $farm_id
 * @property-read \App\Models\Rabbit|null $adoptiveMother
 * @property-read \App\Models\Farm|null $farm
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rabbit> $rabbits
 * @property-read int|null $rabbits_count
 * @property-read \App\Models\Whelping|null $whelping
 * @method static \Database\Factories\AdoptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereAdoptionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereAdoptionMother($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adoption whereWhelpingId($value)
 */
	class Adoption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Farm
 *
 * @property int $id
 * @property string $name
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Adoption> $adoptions
 * @property-read int|null $adoptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pairing> $pairings
 * @property-read int|null $pairings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rabbit> $rabbits
 * @property-read int|null $rabbits_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Weaning> $weanings
 * @property-read int|null $weanings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Whelping> $whelpings
 * @property-read int|null $whelpings_count
 * @method static \Database\Factories\FarmFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Farm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Farm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Farm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Farm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Farm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Farm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Farm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Farm whereUserId($value)
 */
	class Farm extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Farrowing
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Farrowing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Farrowing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Farrowing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Farrowing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Farrowing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Farrowing whereUpdatedAt($value)
 */
	class Farrowing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mortality
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Mortality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mortality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mortality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mortality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mortality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mortality whereUpdatedAt($value)
 */
	class Mortality extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pairing
 *
 * @property int $id
 * @property string $pairing_date
 * @property string $observation
 * @property int|null $father_id
 * @property int|null $mother_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $farm_id
 * @property-read \App\Models\Farm|null $farm
 * @property-read \App\Models\Rabbit|null $father
 * @property-read \App\Models\Rabbit|null $mother
 * @property-read \App\Models\Whelping|null $whelping
 * @method static \Database\Factories\PairingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereFatherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereMotherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing wherePairingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pairing whereUpdatedAt($value)
 */
	class Pairing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rabbit
 *
 * @property int $id
 * @property string $name
 * @property string|null $race
 * @property string|null $image
 * @property string|null $description
 * @property string $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $adoption_id
 * @property int|null $whelping_id
 * @property int|null $weaning_id
 * @property string|null $whelping_date
 * @property int|null $farm_id
 * @property-read \App\Models\Adoption|null $adoption
 * @property-read \App\Models\Farm|null $farm
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pairing> $fatherInPairing
 * @property-read int|null $father_in_pairing_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pairing> $motherInPairing
 * @property-read int|null $mother_in_pairing_count
 * @property-read \App\Models\Weaning|null $weaning
 * @property-read \App\Models\Whelping|null $whelping
 * @method static \Database\Factories\RabbitFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereAdoptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereRace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereWeaningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereWhelpingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rabbit whereWhelpingId($value)
 */
	class Rabbit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TenantPers
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $data
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Stancl\Tenancy\Database\Models\Domain> $domains
 * @property-read int|null $domains_count
 * @method static \Stancl\Tenancy\Database\TenantCollection<int, static> all($columns = ['*'])
 * @method static \Stancl\Tenancy\Database\TenantCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers query()
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TenantPers whereUpdatedAt($value)
 */
	class TenantPers extends \Eloquent implements \Stancl\Tenancy\Contracts\TenantWithDatabase {}
}

namespace App\Models{
/**
 * App\Models\Treatment
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereUpdatedAt($value)
 */
	class Treatment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $first_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $last_name
 * @property string|null $phone
 * @property-read \App\Models\Farm|null $farm
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Weaning
 *
 * @property int $id
 * @property string $observation
 * @property string $weaning_date
 * @property int|null $whelping_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $adoption_id
 * @property int|null $farm_id
 * @property-read \App\Models\Adoption|null $adoption
 * @property-read \App\Models\Farm|null $farm
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rabbit> $rabbits
 * @property-read int|null $rabbits_count
 * @property-read \App\Models\Whelping|null $whelping
 * @method static \Database\Factories\WeaningFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning query()
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereAdoptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereWeaningDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Weaning whereWhelpingId($value)
 */
	class Weaning extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Whelping
 *
 * @property int $id
 * @property string $whelping_date
 * @property string|null $observation
 * @property int|null $pairing_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $farm_id
 * @property-read \App\Models\Farm|null $farm
 * @property-read \App\Models\Pairing|null $pairing
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rabbit> $rabbits
 * @property-read int|null $rabbits_count
 * @property-read \App\Models\Weaning|null $weaning
 * @method static \Database\Factories\WhelpingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping query()
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping wherePairingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Whelping whereWhelpingDate($value)
 */
	class Whelping extends \Eloquent {}
}

