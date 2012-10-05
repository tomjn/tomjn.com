(function() {
	tinymce.create('tinymce.plugins.typekit', {
		init: function(ed, url) {
			ed.onPreInit.add(function(ed) {

				// Get the DOM document object for the IFRAME
				var doc = ed.getDoc();

				// Create the script we will add to the header asynchronously
				var jscript = "(function() {\n\
					var config = {\n\
						kitId: 'wtc2mfi'\n\
					};\n\
					var d = false;\n\
					var tk = document.createElement('script');\n\
					tk.src = '//use.typekit.net/' + config.kitId + '.js';\n\
					tk.type = 'text/javascript';\n\
					tk.async = 'true';\n\
					tk.onload = tk.onreadystatechange = function() {\n\
						var rs = this.readyState;\n\
						if (d || rs && rs != 'complete' && rs != 'loaded') return;\n\
						d = true;\n\
						try { Typekit.load(config); } catch (e) {}\n\
					};\n\
					var s = document.getElementsByTagName('script')[0];\n\
					s.parentNode.insertBefore(tk, s);\n\
				})();";
/*				var jscript = "var TypekitConfig = {\n\
					kitId: 'wtc2mfi'\n\
					};\n\
					(function() {\n\
						var tk = document.createElement('script');\n\
						tk.src = '//use.typekit.com/' + TypekitConfig.kitId + '.js';\n\
						tk.type = 'text/javascript';\n\
						tk.async = 'true';\n\
						tk.onload = tk.onreadystatechange = function() {\n\
						var rs = this.readyState;\n\
						if (rs && rs != 'complete' && rs != 'loaded') return;\n\
						try { Typekit.load(TypekitConfig); } catch (e) {}\n\
					};\n\
					var s = document.getElementsByTagName('script')[0];\n\
					s.parentNode.insertBefore(tk, s);\n\
				})();";*/

				// Create a script element and insert the TypeKit code into it
				var script = doc.createElement("script");
				script.type = "text/javascript";
				script.appendChild(doc.createTextNode(jscript));

				// Add the script to the header
				doc.getElementsByTagName('head')[0].appendChild(script);

			});

		},
		getInfo: function() {
			return {
				longname: 'TypeKit For TinyMCE',
				author: 'Tom J Nowell',
				authorurl: 'http://tomjn.com/',
				infourl: 'http://twitter.com/tarendai',
				version: "1.0"
			};
		}
	});
	tinymce.PluginManager.add('typekit', tinymce.plugins.typekit);
})();