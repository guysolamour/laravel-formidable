<hr>
<footer class="footer" id="footer">
    <div class="container">
       <div class="col-12">
            <ul class="nav justify-content-center">

                @if (Route::has('front.about.index'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.about.index') }}">A propos</a>
                </li>
                @endif

                @if (Route::has('front.post.index'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.post.index') }}">Articles</a>
                </li>
                @endif

                @if (Route::has('front.testimonial.index'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.testimonial.index') }}">Témoignages</a>
                </li>
                @endif

                @if (Route::has('front.legalmention.index'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.legalmention.index') }}">Politique de confidentialité</a>
                </li>
                @endif

            </ul>
            <p class="text-center mt-5">
                Copyright &copy; {{ date('Y') }} | Tous droits reservés <br />
                Il est strictement interdit de copier ou cloner le contenu du site sans l'accord express du propriétaire.
                <br>
                N'oubliez pas de nous suivre !
            </p>
       </div>

    </div>
</footer>
