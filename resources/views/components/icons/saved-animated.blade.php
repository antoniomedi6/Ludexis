<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.7.1/dist/dotlottie-wc.js" type="module"></script>

<dotlottie-wc src="{{ Storage::url('gifs/saved-animated.json') }}" speed="6"
    {{ $attributes->merge(['class' => '']) }} mode="forward" autoplay>
</dotlottie-wc>
