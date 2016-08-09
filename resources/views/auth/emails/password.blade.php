Cliquez ici pour changer de mot de passe: <a href="{{ $link = url('mot-de-passe/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
