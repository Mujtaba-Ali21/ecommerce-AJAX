<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
      body {
        background-image: linear-gradient(to right top, #8b151b, #e0e5f3);
        min-height: 100vh;
      }

      .details {
        border: 1.5px solid grey;
        color: #212121;
        width: 100%;
        height: auto;
        box-shadow: 0px 0px 10px #212121;
        margin-right: 10px;
      }

      .cart {
        border: 1.5px solid grey;
        color: #eee;
        width: 100%;
        height: auto;
        box-shadow: 0px 0px 10px #212121;
      }

      .card {
        width: fit-content;
      }

      .card-body {
        width: fit-content;
      }

      .btn {
        border-radius: 0;
      }

      .img-thumbnail {
        border: none;
      }

      .card {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        padding-bottom: 10px;
      }

      .customBtn {
        border: 1.5px solid grey;
        border-radius: 4px;
        margin: 10px;
        color: #eee;
        height: auto;
        box-shadow: 0px 0px 10px #212121;
      }
    </style>

    <title>Products</title>
  </head>

  <body>
    
  @if(session()->has('success'))
    <div
      class="alert alert-dark text-dark"
      role="alert"
    >
      Product Deleted Successfully!
    </div>

    @endif

      <div class="d-flex justify-content-end mt-2 ms-4">
        <a href="/" target="blank" class="btn bg-danger bg-dark text-light customBtn">Create a Product</a>
      </div>

    @foreach($data as $product) 
        @if($product->status != 0)
            <div class="container">
                <div class="card mx-auto col-md-10 col-sm-10 col-lg-9 col-10 mt-5">
                    <img
                    class="mx-auto img-thumbnail"
                    src="{{ asset('images/' . $product->image) }}"
                    alt="{{$product->name}}"
                    width="auto"
                    height="auto"
                    />
                    <hr />
                    <div class="card-body text-center mx-auto">
                    <div class="cvp">
                        <h5 class="card-title font-weight-bold mb-2">{{$product->name}}</h5>
                        <hr />
                        <p class="card-text">{!!$product->description!!}</p>
                        <hr />
                        <div
                        class="d-flex justify-content-center align-items-center text-center"
                        >
                        <a href="edit/{{ $product->id }}" class="btn details px-auto"
                            >Edit</a
                        >
                        <a href="/delete/{{ $product->id }}" class="btn cart bg-danger px-auto">Delete</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @endif 
    @endforeach
  </body>
</html>
