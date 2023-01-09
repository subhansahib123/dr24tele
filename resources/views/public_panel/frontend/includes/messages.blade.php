<div class="row my-2 mt-4">
    <div class="col-12">
        @if(Session::get('success', false))
        <?php $data = Session::get('success'); ?>
        @if (is_array($data))
            @foreach ($data as $msg)
                {{-- <div class="alert alert-success" role="alert">
                    <i class="fa fa-check"></i>
                    {{ $msg }}
                </div> --}}

                <div class="alert alert-success">
                    <strong>Success Message</strong>
                    <hr class="message-inner-separator">
                    <p> {{ $msg }}.</p>
                </div>
            @endforeach
        @else

            <div class="alert alert-success">
                <strong>Success Message</strong>
                <hr class="message-inner-separator">
                <p> {{ $data }}.</p>
            </div>
        @endif
        @endif
        @if (count($errors) > 0)


        <div class="alert alert-danger">
            <strong>Danger Message</strong>
            <hr class="message-inner-separator">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}.</p>
            @endforeach
        </div>
        @endif

    </div>

</div>


