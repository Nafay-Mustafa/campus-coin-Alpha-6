# SRS Feature Checklist

| Requirement area | Status in project | Main location |
|---|---|---|
| Student registration/login | Implemented | Laravel Fortify + auth views |
| Password recovery/reset | Provided by Fortify | `/forgot-password` |
| Profile: name, academic year, allowance, saving goal | Implemented | `/profile-settings` |
| CSV transaction import | Implemented | Reports page |
| Default + personal categories | Implemented | Dashboard/Admin |
| Add/edit/delete transactions | Implemented | Dashboard + edit page |
| Recurring transaction flag/frequency | Implemented | Transaction form |
| Personalized dashboard | Implemented | Dashboard |
| Current balance | Implemented | Dashboard |
| Top category | Implemented | Dashboard |
| Budget vs actual | Implemented | Dashboard/Budgets |
| Six-month income/expense trend | Implemented | Dashboard |
| Saving tips | Implemented | Dashboard |
| Smart category suggestion | Implemented as local rule-based suggestion | Transaction controller |
| Monthly insight | Implemented as local advisory insight | Insights page |
| Insight history | Stored per month | `insights` table |
| Budget limits and progress | Implemented | Budgets/Dashboard |
| In-app budget warning | Implemented in saving-tip engine | Dashboard |
| Bookmark tips/insights | Implemented | Saved page |
| Monthly report filters | Implemented | Reports |
| CSV export | Implemented | Reports |
| PDF output | Browser Print / Save as PDF | Reports |
| Admin login/control panel | Implemented | `/admin/login` |
| Default category management | Implemented | Admin |
| User/usage statistics | Implemented | Admin |
| Dark mode | Implemented | Header toggle |
| Responsive layout | Implemented | Shared responsive CSS |
| Breadcrumb requirement | Simplified navigation via persistent header + sitemap | Layout/Sitemap |
| Loading indicators | Native form/browser loading behavior; no custom chart loader | — |
| Sitemap on application | Implemented | `/sitemap` |
| Database design/schema | Implemented | migrations + `database/schema.sql` |
| Documentation | Included | `docs/PROJECT_REPORT.md`, `ReadMe.doc` |
| Test credentials | Included | Seeder + documentation |
| Installation instructions | Included | `ReadMe.doc` |
| Video demonstration | Must be recorded by project owner | Submission deliverable |

## Optional/limited items
The SRS marks AI assistance, forecasting and unusual/duplicate detection as optional. The current project uses local, explainable rules for smart category suggestions and monthly insights rather than claiming an external machine-learning service.
