## SilverSripe Simple news module

A simple news module for SilverStripe

## Requirements

* SilverStripe 3.1

## Usage

To get news entries outside the module you can use the provided NewsHelper::Entries() static method:

	class Page_Controller extends ContentController {
		function LatestNews() {
			$itemToSkip = 0;
			$itemsToReturn = 5;
			$namespace = "news";
			return NewsHelper::Entries($itemsToSkip, $itemToReturn, $namespace);
		}
	}

The namespace parameter is configured on the NewsHolder, and can be used to set up several news sections with different
news content. For instance you might want a news section with general news, one section with press releases and one
section with financial news. In that case the general news section might have the namespace "news", press releases might
be called "press" and the financial section could have the namespace "financial".

If you leave the third parameter empty the NewsHelper::Entries() method will return items regardless of the namespace.
It is also possible to list items from several selected namespaces by separating them with a comma:

	class Page_Controller extends ContentController {
		function LatestNews() {
			$itemToSkip = 0;
			$itemsToReturn = 5;
			$namespace = "news,press";
			return NewsHelper::Entries($itemsToSkip, $itemToReturn, $namespace);
		}
	}

## RSS

The news module produces an RSS feed that can be accessed by pointing to the NewsHolder's URL segment and adding /rss at
the end, like so: `www.domain.com/news/rss`

This only displays the NewsItems in that specific NewsHolder's namespace (in the case above, "news").

To display NewsItems from selected NewsHolders you can call rss with namespaces, like so: `www.domain.com/news/news,press`

To display NewsItems from all NewsHolders regardless of namespace, use "*" as namespace, like so: `www.domain.com/news/*`
