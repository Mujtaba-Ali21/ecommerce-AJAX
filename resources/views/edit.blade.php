<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
      crossorigin="anonymous"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Froala Editor CDNs -->

    <link
      rel="stylesheet"
      href="{{ asset('css/froala_editor.pkgd.min.css') }}"
    />

    <script
      type="text/javascript"
      src="{{ asset('js/froala_editor.pkgd.min.js') }}"
    ></script>
    <title>Update Product</title>
  </head>

  <body>
    <!-- Success Alert -->
    <div
      class="alert alert-dark text-dark"
      style="display: none"
      id="created"
      role="alert"
    >
      Product Updated Successfully!
    </div>

    <div class="d-flex justify-content-end mt-2 ms-4">
        <a href="/show" target="blank" class="btn text-light customBtn" style="background-color: #343a40">Go Back</a>
    </div>

    <div class="container contact-form">
      <div class="contact-image">
        <img
          src="https://image.ibb.co/kUagtU/rocket_contact.png"
          alt="rocket_contact"
        />
      </div>

      <form enctype="multipart/form-data" id="myForm">
        @csrf()

        <h3>Update Product</h3>

        <!-- Alert For Errors -->
        <div
          class="alert alert-danger alert-block text-danger text-capitalize"
          id="error"
          style="display: none"
        ></div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Product Name"
                name="productName"
                value="{{$data[0]->name}}"
              />
            </div>

            <br />

            <div class="form-group">
              <input
                type="file"
                id="file"
                class="form-control"
                name="productImage"
              />
            </div>

            <br />

            <div class="form-group">
              <select
                class="form-select"
                aria-label="Default select example"
                name="productStatus"
              >
                <option @if ($data[0]->status == 0) selected @endif>0</option>
                <option @if ($data[0]->status == 1) selected @endif>1</option>
              </select>
            </div>

            <div class="form-group mt-3">
              <input
                type="submit"
                name="submitBtn"
                id="submitBtn"
                class="btnContact"
                value="Update"
              />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <textarea
                name="productDescription"
                id="description"
                class="form-control"
                rows="3"
                placeholder="Product Description"
              >
{{$data[0]->description}}</textarea
              >
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>

  <script>
    $(document).ready(function () {
      // Froala Editor
      var editor = new FroalaEditor("#description");

      $("#submitBtn").click(function (e) {
        e.preventDefault();

        $("#submitBtn").prop("disabled", true);

        var formData = new FormData($("#myForm")[0]);

        $.ajax({
          url: '{{ url("/update/".$data[0]->id) }}',
          data: formData,
          type: "POST",
          contentType: false,
          processData: false,
          success: function () {
            $("#created").fadeIn(2000).fadeOut(7000);
            $("#submitBtn").prop("disabled", false);
          },
          error: function (xhr, textStatus, errorThrown) {
            if (xhr.status === 422) {
              var errors = xhr.responseJSON.errors;
              printErrors(errors);
            }
          },
        });

        function printErrors(msg) {
          var errorHtml = "";
          errorHtml += "<strong>Errors:</strong>";
          $.each(msg, function (key, value) {
            errorHtml += "<li>" + value + "</li>";
          });
          $("#error").html(errorHtml).fadeIn(1000).fadeOut(6000);
        }

        // Clear form fields
        $(".form-control").val("");
        editor.html.set("");
      });
    });
  </script>
</html>
