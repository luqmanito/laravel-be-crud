<?php

namespace App\Http\Requests;

use App\Models\Business;
use App\Models\User;
use App\Rules\PasswordStrength;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
      'password' => ['required', 'confirmed', new PasswordStrength()],
      'business_email' => ['nullable', 'email', 'max:128'],
      'business_name' => ['required', 'string', 'min:3', 'max:255'],
    ];
  }

  public function persist()
  {
    $business = new Business();
    $business->name = $this->business_name;
    $business->email = $this->email;
    $business->save();

    $user = new User();
    $user->business_id = $business->id;
    $user->name = $this->name;
    $user->email = $this->email;
    $user->password = bcrypt($this->password);

    $user->save();

    return $user->fresh();
  }
}
