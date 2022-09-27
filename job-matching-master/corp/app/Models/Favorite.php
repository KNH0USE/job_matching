<?php
namespace App\Models;

class Favorite extends BaseModel
{
  // お気に入りテーブル
  protected $table = 'favorites';
  protected $fillable =
  [
      'student_id',
      'corporation_id',
      'type',
      'status'
  ];

  public function student() {
    return $this->hasMany(Student::class);
  }

  public function corporation() {
    return $this->hasMany(Coporation::class);
  }

}
