<style>
    
</style>
<div class="body">
    <h3><b>Confirm your email address on Maita card</b></h3>
    <p>
    Hi! We just need to verify <span style="color:blue"><b>{{ $user->email }}</b></span> is your email address. <br>
    Click the button below to confirm <br>
    <a href='{{ url("confirmed/$user->id") }}'>
        <button>Confirm</button>
    </a>
    <br><br>

    <b>Didn’t request this email?</b> <br>
    No worries! Your address may have been entered by mistake. If you ignore or delete this email, nothing further will happen.
    </p>
</div>