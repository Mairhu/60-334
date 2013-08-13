<?xml version="1.0" ?>
<xsl:stylesheet 
  version="1.0" 
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
>
  <xsl:param name="sortby" />
  <xsl:param name="type" />
  <xsl:param name="order" />

  <xsl:output
    method="xml"
    encoding="utf-8"
    omit-xml-declaration="yes"
    indent="no"
  />

  <xsl:template match="/">
		<xsl:apply-templates select="menu" />
  </xsl:template>

  <xsl:template match="menu">
    <xsl:text disable-output-escaping="yes">&lt;h1>Appetizers&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="appetizer">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="appetizer" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
	
	<xsl:text disable-output-escaping="yes">&lt;h1>Soups&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="soup">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="soup" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
  <xsl:text disable-output-escaping="yes">&lt;h1>Noodle Soups&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="noodlesoup">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="noodlesoup" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Chicken Dishes&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="chickendishes">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="chickendishes" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Beef Dishes&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="beefdishes">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="beefdishes" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Seafood Dishes&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="seafooddishes">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="seafooddishes" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Side Orders&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="sideorder">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="sideorder" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Pork Dishes&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="porkdishes">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="porkdishes" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Vegetable Dishes&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="vegetabledishes">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="vegetabledishes" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Noodles&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="noodles">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="noodles" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Rice Dishes&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="ricedishes">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="ricedishes" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Dinner For One&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="dinnerforone">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="dinnerforone" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  
	<xsl:text disable-output-escaping="yes">&lt;h1>Dinners For Multiples&lt;/h1></xsl:text>
	<table class="xslTable">
	  <thead>
		<tr>
		  <td>
            <a href="&s=i" class="header">Index</a>
          </td>
          <td>
            <a href="&s=ds" class="header">Dish</a>
          </td>
          <td>
            <a href="&s=pr" class="header">Price</a>
          </td>
		</tr>
	  </thead>
	  <tbody>
		<xsl:choose>
		  <!--If-->
		  <xsl:when test="$sortby">
			<xsl:apply-templates select="dinner">
			  <xsl:sort 
				select="child::*[name()=$sortby]"
			  />
			</xsl:apply-templates>
		  </xsl:when>
		  <!--Else-->
		  <xsl:otherwise>
		    <xsl:apply-templates select="dinner" />
		  </xsl:otherwise>
		</xsl:choose>
	  </tbody>
	</table>
  </xsl:template>
  
  <!--BEGINNING OF THE ACTUAL TEMPLATES FOR THE DATA IN THE TABLE-->
  
  <xsl:template match="appetizer">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
	
  <xsl:template match="soup">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="noodlesoup">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="chickendishes">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="beefdishes">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="seafooddishes">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="sideorder">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="porkdishes">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="vegetabledishes">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="noodles">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="ricedishes">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="dinnerforone">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>
  
  <xsl:template match="dinner">
    <xsl:variable name="index" select="position()" />
      <!-- TODO: Proper <tr> constructor goes here! -->
	  <xsl:choose>
		<!--If index is even-->
	    <xsl:when test="($index mod 2) = 0">
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>even</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:when>
		<!--Otherwise index is odd-->
		<xsl:otherwise>
			<xsl:element name="tr">
				<xsl:attribute name="class">
					<xsl:text>odd</xsl:text>
				</xsl:attribute>
			</xsl:element>
		</xsl:otherwise>
	  </xsl:choose>
      <!-- The data for the "Index" column is just the position(). I have
           provided it for you: -->
      <td><xsl:value-of select="$index" /></td>
	  <xsl:apply-templates select="name" />
	  <xsl:apply-templates select="price" />
  </xsl:template>

  <xsl:template match="price">
	<td>
	  <xsl:text>$</xsl:text>
	  <xsl:value-of select="format-number(., '###.00')" />
	</td>
  </xsl:template>

  <xsl:template match="node()">
    <td><xsl:value-of select="./text()" /></td>
  </xsl:template>

  <xsl:template match="@*|text()|comment()|processing-instruction()" />
</xsl:stylesheet>
