# Inside Strata Theme

This repository contains the WordPress theme for the Inside Strata project. The repository is intentionally limited to the theme directory (`wp-content/themes/inside-strata-theme`) and a few supporting files. All WordPress core files and other content are ignored; only deliverables related to the theme are tracked.

---

## Project Brief

*I am now essentially a contractor only working on this project; I am able to work remote doing this as I am not part of the core team anymore.*

### Inside Strata

A simple publishing platform to deliver news and promotional content. The theme is the only deliverable; WordPress will supply the CMS functionality. The goal is a clean, easy-to-use experience for the internal team to publish articles with advertising slots.

Key requirements:

- **Easy-to-use CMS**
  - A blog/news outlet where content can be created, edited, and deleted.
  - Support for ad slots both on site pages and within articles.
- **Publishing workflow**
  - Ability to create and publish news articles quickly.
  - CMS interfaces should be intuitive since the core team won't be managing code.
- **Advertising**
  - Ads need to be configurable and placed in site templates and inside post content.
- **Design freedom**
  - Creative flexibility for UI/UX; minimal design constraints from the brief.
  - Look and feel can take inspiration from media publishers such as [Momentum Media](https://www.momentummedia.com.au/).
- **Reference**
  - Multiple brands and outlets are targeted; initial phase should focus on a straightforward article publishing and self-promotion platform.

### Deliverables

- WordPress theme located at `wp-content/themes/inside-strata-theme`.
- Documentation (this README) explaining repository structure and usage.

### Getting Started

1. **Local development**
   - Install WordPress separately (outside this repo or via a different branch).
   - Place this theme in `wp-content/themes/inside-strata-theme` and activate it.
   - Develop and test theme features using standard WordPress tooling (WP CLI, etc.).

2. **Publishing**
   - Use WordPress admin to create posts and manage ad slots.
   - Ads can be implemented using custom fields or widgets depending on needs.

3. **Deployment**
   - The theme folder is the only thing that needs to be pushed to production environments.
   - Keep the repository private and share with stakeholders as needed.

### Notes

- This repository tracks only the theme deliverable. WordPress core, plugins, uploads, and other files are ignored via `.gitignore`.
- Feel free to create additional documentation or subfolders within the theme as development progresses.

---

*Built by a former contractor/rails engineer looking to deliver a lightweight, maintainable WordPress theme for Inside Strata.*