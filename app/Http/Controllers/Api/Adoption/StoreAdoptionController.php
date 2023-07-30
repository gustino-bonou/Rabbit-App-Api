<?php

namespace App\Http\Controllers\Api\Adoption;

use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionRequest;
use App\Actions\Adoption\StoreAdoptionAction;
use App\Responses\Adoption\AdoptionCollectionResponse;
use App\Http\DataTransfertObject\Adoption\AdoptionData;

class StoreAdoptionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdoptionRequest $request)
    {
        $dto = new AdoptionData(
            adoptionDate: $request->validated('adoption_date'),
            observation: $request->validated('observation'),
            motherId: $request->validated('adoption_mother'),
            whelpingId: $request->validated('whelping_id'),
            farmId: $request->user()->farm_id,
        );

        (new StoreAdoptionAction)->handle(
            ...$dto->toArray()
        );


        return  new AdoptionCollectionResponse(
            collection: Adoption::with([
                    'rabbits',
                    'adoptiveMother',
                    'whelping'
                ])->orderBy('created_at')
                ->paginate(15)
            );
    }
}

/* 
// La fonction fetchAdoptions récupère les données JSON depuis l'API et les transforme en liste d'objets Adoption.
Future<List<Adoption>> fetchAdoptions() async {
  final response =
      await http.get('http://192.168.71.1:8000/adoptions/store?page=1');

  if (response.statusCode == 200) {
    final jsonMap = json.decode(response.body);
    final List<dynamic> jsonData = jsonMap['data'];

    return jsonData.map((data) => Adoption(
      id: data['id'],
      adoptionDate: data['adoption_date'],
      observation: data['observation'],
      mother: Mother(
        id: data['mother']['id'],
        name: data['mother']['name'],
        description: data['mother']['description'],
        race: data['mother']['race'],
        gender: data['mother']['gender'],
        weaning: data['mother']['weaning'] != null ? Weaning(
          id: data['mother']['weaning']['id'],
          birthDate: data['mother']['weaning']['weaning_date'],
          observation: data['mother']['weaning']['observation'],
        ) : null,
        whelping: data['mother']['whelping'] != null ? Whelping

*/