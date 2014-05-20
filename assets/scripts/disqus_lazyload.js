/**
 * Disqus Lazy Load by Scott Vinkle
 * Source Code: http://codepen.io/svinkle/pen/mAfes
 *
 * This version has been modified by José SAYAGO from L'Elite
 */
(function () {
	'use strict';
	// Global object
	var App = {};  

	if( document.getElementById('article-comments') != null ) {

		// Create button
		App.commentsButton = document.createElement('button');
		App.commentsButton.setAttribute('id', 'comments-button');
		App.commentsButton.setAttribute('class', 'btn btn-default');
		App.commentsButton.setAttribute('data-js', 'comments-button');
		// Get Domain
		var myDomain = window.location.host;
		switch( myDomain ) {
			case 'fundacion-sanando.org':
				App.commentsButton.innerHTML = 'Comentarios <span class="glyphicon glyphicon-comment"></span>';
				break;
			default:
				App.commentsButton.innerHTML = 'Comentarios <span class="glyphicon glyphicon-comment"></span>';
				break;
		}
		// Append button to body
		document.getElementById('article-comments').appendChild( App.commentsButton );

		if( document.getElementById('comments-button') != null ) {

			if( window.location.hash ) {
				var getButton = document.getElementById('comments-button');
				// Remove button on click
				getButton.parentNode.removeChild(getButton);
				// Create comments container
				App.disqusContainer = document.createElement('div');
				App.disqusContainer.setAttribute('id', 'disqus_thread');
				// Append container to body
				document.getElementById('article-comments').appendChild( App.disqusContainer );
				// Get Domain
				var myDomain = window.location.host;
				switch( myDomain ) {
					case 'fundacion-sanando.org':
						// Disqus Shortname
						App.disqus_shortname = 'fundacionsanando';
						break;
					default:
						// Disqus Shortname
						App.disqus_shortname = 'fundacionsanando';
						break;
				}
				// Embed Disqus
				var dsq = document.createElement('script');
				dsq.type = 'text/javascript';
				dsq.async = true;
				dsq.src = '//' + App.disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			}
		}

		// Click event handler
		App.commentsButton.onclick = function () {
			// Remove button on click
			this.parentNode.removeChild(this);
			// Create comments container
			App.disqusContainer = document.createElement('div');
			App.disqusContainer.setAttribute('id', 'disqus_thread');
			// Append container to body
			document.getElementById('article-comments').appendChild( App.disqusContainer );
			// Get Domain
			var myDomain = window.location.host;
			switch( myDomain ) {
				case 'fundacion-sanando.org':
					// Disqus Shortname
					App.disqus_shortname = 'fundacionsanando';
					break;
				default:
					// Disqus Shortname
					App.disqus_shortname = 'fundacionsanando';
					break;
			}
			// Embed Disqus
			var dsq = document.createElement('script');
			dsq.type = 'text/javascript';
			dsq.async = true;
			dsq.src = '//' + App.disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		};
	}
})();