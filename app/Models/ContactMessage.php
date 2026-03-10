<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message'];


    public function store($data){
        return ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
    }


    public function getAllPaginated($perPage=20){
        return ContactMessage::orderBy('created_at','desc')
            ->paginate($perPage);
    }

    public function deleteMessage($id){
        return ContactMessage::findOrFail($id)->delete();
    }
}
