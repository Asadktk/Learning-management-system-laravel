@props(['isLoggedIn' => false])

@if ($isLoggedIn)
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@else
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
