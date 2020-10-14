@component('mail::message')
# رمز عبور جدید

برای انتخاب رمز جدید بر روی دکمه زیر کلیک کنید
<br>
@component('mail::button', ["url" =>"{$link}"])
ایجاد رمز جدید 
@endcomponent

ممنون از عضویت شما,<br>
{{ config('app.name') }}
@endcomponent
