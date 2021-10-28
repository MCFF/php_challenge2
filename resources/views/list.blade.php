<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  </head>
  <body>
    <div>
      <ul class="d-inline-flex p-2 bd-highlight justify-content-between list-unstyled w-100">
        @foreach ($contacts as $contact)
            <li class="shadow-sm p-0 bg-body rounded">
              <a href="/details/{{$contact->id}}" class="text-body text-decoration-none">
                <div class="card" style="width: 10rem">
                  <img src={{$contact->avatar}} class="card-img-top position-relative" />

                  <div class="card-body">

                    <p class="card-text">
                      {{$contact->first_name}} {{$contact->last_name}}
                    </p>
                    <p class="card-text">{{$contact->email}}</p>
                  </div>
                </div>
              </a>
            </li>
          @endforeach
      </ul>
    </div>
  </body>
</html>
