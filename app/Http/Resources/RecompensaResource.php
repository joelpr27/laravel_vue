<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecompensaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        //if no resize image
    
        $resized_image="";
        try {
            $resized_image = $this->getMedia('*');//[0]->getUrl('resized-image');
           // return resized_image;
            if(count($resized_image) != 0){
               // $resized_image = $resized_image[0]->getUrl('resized-image');
            }
        } catch (Exception $e) {
            $resized_image="";
        }
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'categorias' => $this->categorias,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'usuario_id' => $this->usuario_id,
            'nivel_desbloqueo' => $this->nivel_desbloqueo,
            'original_image' => count($this->getMedia('*')) > 0 ? $this->getMedia('*')[0]->getUrl() : null,
            'resized_image' => $resized_image,
            'created_at' => $this->created_at?->toDateString()
        ];
        return parent::toArray($request);
    }
}
