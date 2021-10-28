<!DOCTYPE html>
<html lang="en">
  <head>
      
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  </head>
  <body>

    <div class="d-flex flex-column align-items-center">
      <div class="border border-secondary rounded-3 d-flex flex-column align-items-center mt-5 w-25 p-5 shadow p-3 mb-5 bg-body rounded">
        <div>
          <img src=<?php echo $contactInfo->avatar ?> />
        </div>
        <div>
          <p>
            <span id="contactInfoName">
            <?php echo $contactInfo->first_name." ".$contactInfo->last_name; ?>
            </span>
          </p>
          <p>
            <span id="contactInfoEmail"><?php echo $contactInfo->email ?></span>
          </p>
          <div class="d-flex justify-content-center">
            <button class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#modalEdit">
              Edit
            </button>
            <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#modalDelete">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">

          </div>
          <div class="modal-body">
            <h4>Are you sure you want to delete this contact?</h4>
          </div>
          <div class="modal-footer">
            <button id="deleteContact" type="button" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header"></div>
          <div class="modal-body">
            <div class="d-flex flex-column">
          <h1 class="mt-5">Edit contact</h1>
            <input
              id="nameField"
              type="text"
              value=<?php echo $contactInfo->first_name; ?>
              placeholder="Name"
              class="mt-3"
            />
            <input
              id="lastNameField"
              type="text"
              value=<?php echo $contactInfo->last_name; ?>
              placeholder="Last name"
              class="mt-3"
            />
            <input
              id="emailField"
              type="text"
              value=<?php echo $contactInfo->email; ?>
              placeholder="Email"
              class="mt-3"
            />
            <button
              id="saveEditContact"
              type="button"
              class="btn btn-success mt-5 mb-5">Save</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" defer>

      document.getElementById('deleteContact').addEventListener('click', deleteContact);
      document.getElementById('saveEditContact').addEventListener('click', saveContact);
      
      function deleteContact(){
        fetch(`https://reqres.in/api/users/<?php echo $contactInfo->id; ?>`, {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
          },
        }).then(async (response) => {
          const status = response.status;
          if (status === 204) {
            window.history.back();
          }
        });
      }

      function saveContact(){
        const name = document.getElementById('nameField').value
        const lastName = document.getElementById('lastNameField').value
        const email = document.getElementById('emailField').value
      
        if (name === null || lastName === null || email === null){
          alert('Please enter a name or a last name or email address');
        }else{
        
          fetch(`https://reqres.in/api/users/<?php echo $contactInfo->id; ?>`, {
            method: "PUT",
            body: JSON.stringify({
              name: name,
              lastName: lastName,
              email: email,
            }),
            headers: {
              "Content-Type": "application/json",
            },
          }).then(async (response) => {
            document.getElementById('contactInfoName').innerText = name+" "+lastName;
            document.getElementById('contactInfoEmail').innerText = email;
          
            const modal = document.getElementById('modalEdit');
          
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            modal.setAttribute('style', 'display: none');
          
            const modalsBackdrops = document.getElementsByClassName('modal-backdrop');
          
            for(let i=0; i<modalsBackdrops.length; i++) {
              document.body.removeChild(modalsBackdrops[i]);
            }
          });
        }
      }
    </script>
  </body>
</html>
