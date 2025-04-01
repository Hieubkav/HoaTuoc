<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'status' => $this->status,
            'thumbnail' => $this->thumbnail,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|string',
            'status' => 'required|string|in:visible,hidden',
            // Không bắt buộc slug vì sẽ được tự động tạo bởi Observer
            'slug' => 'nullable|string|max:255',
        ];
    }
}