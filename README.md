## SilverSripe Simple news module

A simple news module for SilverStripe

## Requirements

* SilverStripe 3.1

## Usage

To get news entries you can use the static method `NewsHelper::Entries()`:

	class Page_Controller extends ContentController
	{
		function LatestNews() {
			$itemToSkip = 0;
			$itemsToReturn = 5;
			$namespace = 'news';
			return NewsHelper::Entries($itemsToSkip, $itemToReturn, $namespace);
		}
	}

The namespace parameter is configured on the NewsHolder, and can be used to set up several news sections with different
news content. For instance you might want a news section with general news, one section with press releases and one
section with financial news. In that case the general news section might have the namespace "news", press releases might
be called "press" and the financial section could have the namespace "financial".

If you omit the third parameter the `NewsHelper::Entries()` method will return items regardless of the namespace.
It is also possible to list items from several selected namespaces by separating them with a comma:

	class Page_Controller extends ContentController
	{
		function LatestNews() {
			$itemToSkip = 0;
			$itemsToReturn = 5;
			$namespace = 'news,press';
			return NewsHelper::Entries($itemsToSkip, $itemToReturn, $namespace);
		}
	}

## RSS

The news module produces an RSS feed that can be accessed by pointing to the NewsHolder's URL segment and adding /rss at
the end. You may also provide additional parameters to control which namespaces entries should be returned from as well
as limit and the number of items to skip.

Format: `http://www.domain.com/news/rss/[namespace(s)]/[limit],[skip]`

* [namespace(s)] can contain one or more namespaces separated with a comma;  `http://www.domain.com/news/rss/news,press/`
* [limit] and [skip] must both be integer values.
* If you do not provide the [skip] argument, a default of 0 is used
* If you do not provide the [limit] argument, a default of 20 is used
* If you do not provide the [namespace(s)] argument, the namespace of the called newsholder will be used
* You may provide a wildcard as [namespace(s)] to display entries from all namesspaces; `http://www.domain.com/news/rss/*/`