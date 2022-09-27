<?php
namespace App\Models;

class Industry extends BaseModel
{
  // 業種テーブル
  protected $table = 'industries';
  protected $fillable =
  [
      'name'
  ];

  public function students() {
    return $this->hasMany(Student::class);
  }

}
