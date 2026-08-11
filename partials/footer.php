		</main>
		<footer class="site-footer">
			<p>A lightweight profile site built with plain HTML, CSS, and PHP includes.</p>
		</footer>
		<img id="confetti" src="/images/confetti.gif" alt="Hooray" />
	</div>
	<script>
		(function () {
			var userInput = [];
			var validCode = '38384040373937396665';
			var maxInputArrayLength = 10;
			var confetti = document.getElementById('confetti');
			var confettiSrc = confetti ? confetti.getAttribute('src') : '';
			var hornAudio = new Audio('/sounds/noise.wav');

			window.addEventListener('keyup', function (e) {
				var strokedKey = e.keyCode || e.which || false;

				if (!strokedKey) {
					return false;
				}

				userInput.push(strokedKey);

				if (userInput.length > maxInputArrayLength) {
					userInput = userInput.slice(-maxInputArrayLength);
				}

				if (userInput.join('') === validCode && confetti) {
					confetti.classList.add('is-visible');
					confetti.setAttribute('src', confettiSrc);
					hornAudio.play();
					setTimeout(function () {
						confetti.classList.remove('is-visible');
					}, 13500);
				}
			}, true);
		}());
	</script>
</body>
</html>