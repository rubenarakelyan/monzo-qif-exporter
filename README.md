# Monzo QIF Exporter

Export your Monzo transactions in QIF and CSV formats.

# Installation steps

* Configure a web server to point at the `/public` folder. This will need to be its own domain or subdomain.
* Generate a new OAuth client at https://developers.getmondo.co.uk.
* Set the following configuration in `/protected/.env`:

        MONZO_CLIENT_ID=<oauth_id>
        MONZO_CLIENT_SECRET=<oauth_secret>
        MONZO_REDIRECT_URI=<your_host>/r/from-monzo-auth
