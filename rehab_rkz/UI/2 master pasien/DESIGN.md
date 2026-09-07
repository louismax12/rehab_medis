---
name: Clinical Rehabilitation Precision
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#434655'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#737686'
  outline-variant: '#c3c6d7'
  surface-tint: '#0053db'
  primary: '#004ac6'
  on-primary: '#ffffff'
  primary-container: '#2563eb'
  on-primary-container: '#eeefff'
  inverse-primary: '#b4c5ff'
  secondary: '#565e74'
  on-secondary: '#ffffff'
  secondary-container: '#dae2fd'
  on-secondary-container: '#5c647a'
  tertiary: '#006242'
  on-tertiary: '#ffffff'
  tertiary-container: '#007d55'
  on-tertiary-container: '#bdffdb'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dbe1ff'
  primary-fixed-dim: '#b4c5ff'
  on-primary-fixed: '#00174b'
  on-primary-fixed-variant: '#003ea8'
  secondary-fixed: '#dae2fd'
  secondary-fixed-dim: '#bec6e0'
  on-secondary-fixed: '#131b2e'
  on-secondary-fixed-variant: '#3f465c'
  tertiary-fixed: '#6ffbbe'
  tertiary-fixed-dim: '#4edea3'
  on-tertiary-fixed: '#002113'
  on-tertiary-fixed-variant: '#005236'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  display-lg:
    fontFamily: Outfit
    fontSize: 40px
    fontWeight: '600'
    lineHeight: 48px
    letterSpacing: -0.02em
  display-sm:
    fontFamily: Outfit
    fontSize: 30px
    fontWeight: '600'
    lineHeight: 36px
    letterSpacing: -0.015em
  headline-lg:
    fontFamily: Outfit
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Outfit
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
    letterSpacing: -0.005em
  headline-sm:
    fontFamily: Outfit
    fontSize: 16px
    fontWeight: '600'
    lineHeight: 24px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  body-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 16px
  label-md:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '600'
    lineHeight: 18px
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Inter
    fontSize: 11px
    fontWeight: '600'
    lineHeight: 14px
    letterSpacing: 0.03em
  metric-display:
    fontFamily: Outfit
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 36px
    letterSpacing: -0.02em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  space-2xs: 0.125rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 0.75rem
  space-base: 1rem
  space-lg: 1.25rem
  space-xl: 1.5rem
  space-2xl: 2rem
  space-3xl: 3rem
  gutter-table: 1rem
  sidebar-width: 16.5rem
  sidebar-collapsed: 4.5rem
---

## Brand & Style

This design system targets high-acuity physical therapy, occupational therapy, and neuro-rehabilitation hospital clinics. The visual tone balances sterile precision with restorative warmth, reassuring clinicians, physiotherapists, and administrators through structured legibility and surgical responsiveness.

The aesthetic fuses **Modern Corporate** reliability with a refined **Clinical Minimalist** architecture:
- Deep slate structural navigation establishes an authoritative, cockpit-grade anchor for enterprise hospital workflows.
- Expansive, luminous neutral surfaces reduce visual fatigue during 12-hour practitioner shifts.
- High-contrast clinical indicators deliver glanceable clarity for recovery tracking, pain scores, and range-of-motion (ROM) bio-telemetry.

## Colors

The palette prioritizes clinical diagnostic legibility, strict WCAG AAA contrast ratios for vital patient records, and categorical role separation.

### Core Roles
- **Primary Accent (`#2563eb` - Royal Clinical Blue):** Designates interactive clarity, validated actions, primary call-to-actions, and calibrated measurement states.
- **Structural Sidebar (`#0f172a` Slate-900 / `#1e293b` Slate-800):** Establishes an enterprise shell that keeps administrative navigation distinct from live patient data fields.
- **Neutral Canvas (`#f8fafc` Slate-50):** A low-strain, soft clinical backdrop that eliminates screen glare.
- **Surface Elevation (`#ffffff` Pure White):** Clean planar cards for diagnostic readouts, body charts, and progress logs.
- **Text Tiers:** `#0f172a` for primary clinical records and metrics; `#475569` for secondary data labels; `#94a3b8` for muted timestamps and structural dividers.

### Clinical Status Accents
- **Success & Recovery (`#10b981` Emerald-500):** Completed therapy exercises, target range achieved, discharged status. Light tint `#ecfdf5` for backgrounds.
- **Active Queue & Progression (`#f59e0b` Amber-500):** In-session queues, pending physician sign-offs, warning-level fatigue. Light tint `#fffbeb`.
- **Alert & Pain Threshold (`#f43f5e` Rose-500):** Acute pain spike warnings, missed vital signs, contraindications. Light tint `#fff1f2`.

## Typography

The type scale combines **Outfit** for structural headers and clinical telemetry with **Inter** for dense diagnostic tables and narrative therapy assessments.

- **Outfit (Headlines & Metrics):** Delivers clean geometry and distinct numeric forms, critical for rapid angle, velocity, and torque readings in rehabilitation therapy.
- **Inter (Body & Controls):** Provides neutral, tall x-height legibility across multi-column electronic medical records (EMR).
- Tabular figures (`tnum`) must be enforced for all rehabilitation measurement tables, joint angle data, and timeline logs to avoid visual jitter across dynamic inputs.

## Layout & Spacing

The layout is built on a 4px/8px incremental grid tailored for desktop clinical workstations and medical tablet carts.

### Structural Framework
- **Master Shell:** Fixed-width dark navigation sidebar (`16.5rem`) on the left, with an auto-collapsing tablet mode (`4.5rem`).
- **Main Canvas:** Dynamic fluid area (`calc(100vw - 16.5rem)`) with max-width containment of `1680px` for diagnostic consoles to prevent horizontal eye drift.
- **Card Grids:** 12-column dynamic CSS grid using `1.5rem` gutters on desktop, condensing to `1rem` on tablet screens.
- **Clinical Data Density:** Tables leverage compact vertical padding (`0.625rem` row heights) to maximize screen real estate, while patient overview headers retain breathing room (`1.5rem` internal padding).

## Elevation & Depth

Visual hierarchy uses clean planar layering rather than heavy drop shadows, simulating anti-reflective clinical glass and calibrated panels.

- **Base Canvas (Level 0):** `#f8fafc` background layer.
- **Surfaces & Cards (Level 1):** `#ffffff` elevated with a refined multi-stop shadow:
  `box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.04), 0 1px 2px -1px rgba(15, 23, 42, 0.02);` paired with a crisp structural hairline border `1px solid #e2e8f0`.
- **Hover & Interactive Panels (Level 2):** Applied to active patient cards and table selections:
  `box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.06), 0 2px 4px -2px rgba(15, 23, 42, 0.04);`
- **Flyouts, Dropdowns, Pinpoint Popovers (Level 3):**
  `box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.08), 0 4px 6px -4px rgba(15, 23, 42, 0.03);`
- **Modals & Critical Diagnostics (Level 4):**
  `box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.1), 0 8px 10px -6px rgba(15, 23, 42, 0.04);`

## Shapes

The geometric signature uses a unified **12px base radius** across major cards, data panels, and diagnostic views.

- **Container Surfaces:** Exactly `12px` (`0.75rem`) for cards, dialog frames, input fields, and metric widgets.
- **Action Elements:** Primary and secondary buttons maintain `10px` or `12px` to seamlessly match surface harmony.
- **Status & Bio-tags:** Always fully rounded `pill` shapes (`9999px`) to create an immediate shape distinction between functional layout panels and informational diagnostic badges.

## Components

### Buttons
- **Primary:** Background `#2563eb`, solid white text, `border-radius: 10px`, `10px 18px` padding. Subtle top inset bevel (`box-shadow: inset 0 1px 0 rgba(255,255,255,0.15)`). Hover state: `#1d4ed8`.
- **Secondary / Outline:** Background `#ffffff`, border `1px solid #cbd5e1`, text `#0f172a`. Hover state: `#f8fafc`.
- **Destructive:** Background `#fff1f2`, border `1px solid #fecdd3`, text `#e11d48`.

### Status Badges (Pills)
Pill format (`border-radius: 9999px`), `4px 10px` padding, uppercase `label-sm` with a centered 6px dot indicator:
- **Completed / Full ROM:** `#ecfdf5` background, `#047857` text, `#10b981` dot.
- **In-Progress / Queue:** `#fffbeb` background, `#b45309` text, `#f59e0b` dot.
- **Severe / Acute Alert:** `#fff1f2` background, `#be123c` text, `#f43f5e` dot.

### Clinical Data Tables
- Header: `#f8fafc` background with a subtle border `#e2e8f0` bottom rule; text is `#64748b`, uppercase 11px font with tracking `0.05em`.
- Rows: `#ffffff` base with `#f1f5f9` hover transitions. Row division line `1px solid #f1f5f9`. Numeric metrics are right-aligned using tabular figures.

### Interactive Body Map Pinpoints
Used for localized musculoskeletal and neurological rehabilitation tracking:
- **Dormant Joint Pin:** An 8px circular node, `#2563eb` with a 2px `#ffffff` stroke.
- **Flagged Pain/Injury Pin:** A 10px `#f43f5e` circular node with a concentric pulsing ping ring (`rgba(244, 63, 94, 0.25)`).
- **Inspected State:** Outer ring scales to 16px with an anchored floating Level-3 tooltip card displaying VAS Pain Index (1-10), Range of Motion (ROM) deficit in degrees, and date of last physical therapy manipulation.

### Input Fields & Selectors
- Standard input height `40px`, border `1px solid #cbd5e1`, background `#ffffff`, `border-radius: 10px`. Focus ring: `0 0 0 3px rgba(37, 99, 235, 0.15)` with a border tint of `#2563eb`.