<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				  <link rel="stylesheet" href="blueestilo.css" type="text/css"/>
			</head>
			<body>
				<h1><xsl:value-of select="cancion/titulo"></xsl:value-of></h1>
				<h1 class="aut"><xsl:value-of select="cancion/autor"></xsl:value-of></h1>
				<xsl:for-each select="cancion/letra/estrofa">
					<h2>Es<span>tro</span>fa </h2>
					<xsl:for-each select="verso">
						<p class="verso">
						<xsl:value-of select="."/>
						</p>
					</xsl:for-each>
				</xsl:for-each>
			</body>
		</html>
	</xsl:template>
	
	
	
	
	
	
	
	
				
			
		
	
</xsl:stylesheet>
	
	
