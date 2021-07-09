I didn't know how to create a Slack bot. I've never really used one before so had to spend some time figuring out how to set up the Slack app and how best to develop against it. Always looking to leverage exiting mature libraries where possible, I found Botman which is a Laravel app that abstracts away of detail of the specific IM integration.

I used RDS as the target of the instance management so you will need to be able to make RDS API calls.

I used ngrok to forward the events from Slack to my machine. The app uses port 8000 by default.

I created a personal slack space under andyjb.slack.com.

This token needs to be placed in the .env file.

Once dependencies are installed, start the dev server.

You should be able to interact with the bot from Slack. Type 'help' to see a list of management commands.

I had issues creating databases using the API. I was getting capacity errors. I didn't want to spend too long diagnosing that as it likely due to my free tier account.

I also added some of the scraping task using http://quotes.toscrape.com/ as the source.

Type 'tags' to see a list of tags. Type 'quote {tag}' to see a random quote from that tag.
