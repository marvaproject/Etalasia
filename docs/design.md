# Smartlift Watch App Design Specification

## Project Overview

Smartlift is a premium watch shopping and discovery application focused on luxury watches and smart wearable products. The UI emphasizes elegant product presentation, minimal navigation, and a modern mobile-first shopping experience.

---

# Design Principles

- Minimal luxury aesthetic
- Product-first layout
- Large imagery
- Soft neutral backgrounds
- Rounded components
- Clear visual hierarchy
- Black primary actions
- Blue accent interactions
- Card-based shopping experience

---

# Screen Inventory

| Screen | Purpose |
|----------|----------|
| Onboarding | Product introduction and app entry |
| Home | Discovery and featured products |
| Product Listing | Browse all available products |

---

# Global Design Tokens

## Colors

```css
--background: #F5F4F2;
--surface: #FFFFFF;
--primary: #111111;
--secondary: #6D6D6D;
--border: #E9E9E9;
--accent: #3D7BFF;
--rating: #F7B500;
```

## Typography

### Heading XL

```yaml
font-size: 42px
font-weight: 700
line-height: 48px
```

### Heading L

```yaml
font-size: 32px
font-weight: 700
line-height: 38px
```

### Heading M

```yaml
font-size: 24px
font-weight: 600
line-height: 30px
```

### Body

```yaml
font-size: 16px
font-weight: 400
line-height: 24px
```

### Caption

```yaml
font-size: 13px
font-weight: 400
line-height: 18px
```

---

# Screen 01 — Onboarding

## Purpose

Introduce the Smartlift platform and encourage users to begin shopping.

---

## Layout Structure

```text
Safe Area

Progress Indicator
Skip Button

Hero Watch Image

Headline
Description

Primary CTA
```

---

## Components

### Progress Indicator

Position:

```yaml
top: 24
left: 24
```

Properties:

```yaml
steps: 3
active: 3
```

---

### Skip Action

Position:

```yaml
top: 24
right: 24
```

Type:

```yaml
text-button
```

Label:

```text
Skip
```

---

### Hero Product Image

Type:

```yaml
image
```

Alignment:

```yaml
center
```

Content:

```text
Luxury stainless steel chronograph watch
```

---

### Main Heading

```text
Begin Your Smartlift
Watch Journey
```

Style:

```yaml
font: Heading L
alignment: center
```

---

### Supporting Text

```text
Your personal assistant for health activity and daily notifications
```

Style:

```yaml
font: Body
color: secondary
alignment: center
```

---

### CTA Button

Structure:

```text
[ Get Started ] [ → ]
```

Style:

```yaml
background: black
icon-background: accent-blue
shape: pill
height: 56px
```

Action:

```yaml
navigate: Home Screen
```

---

# Screen 02 — Home

## Purpose

Provide product discovery and category exploration.

---

## Layout Structure

```text
Header

Hero Section

Search + Filter

Brand Carousel

Collection Grid

Bottom Navigation
```

---

# Header

## User Avatar

```yaml
shape: circle
size: 40px
```

---

## Store Location

Title:

```text
Store Location
```

Value:

```text
Boston Harbor USA
```

Icon:

```text
Location Pin
```

---

## Cart Button

```yaml
shape: rounded-square
icon: shopping-bag
```

---

# Hero Section

## Title

```text
Top Models
```

## Subtitle

```text
Explore top luxury watch models
```

---

# Search Area

## Search Input

```yaml
placeholder: Search...
icon: Search
height: 48px
radius: 16px
```

---

## Filter Button

```yaml
icon: Sliders
background: black
size: 48px
radius: 16px
```

---

# Top Brands Section

## Header

```text
Top Brands
```

Action:

```text
See all
```

---

## Brand Carousel Item

Structure:

```text
Brand Logo
Brand Name
```

Examples:

```text
Rolex
IWC
Breitling
Hublot
Omega
```

---

# Top Collection Section

## Header

```text
Top Collection
```

Action:

```text
See all
```

---

## Product Card

### Structure

```text
Wishlist Button

Product Image

Product Name
Product SKU

Price
Rating
```

---

### Card Style

```yaml
background: white
radius: 18px
padding: 12px
```

---

### Example Data

```yaml
name: Rolex Submariner
sku: 126610LN
price: $12,350
rating: 5.0
```

```yaml
name: Carrera Calibre
sku: WAR201A
price: $31,985
rating: 4.9
```

---

# Bottom Navigation

## Navigation Items

### Home

```yaml
icon: house
active: true
```

### Favorites

```yaml
icon: heart
```

### Explore

```yaml
icon: shuffle
```

### Profile

```yaml
icon: user
```

### Assistant

```yaml
icon: microphone
background: accent-blue
floating: true
```

---

# Screen 03 — Product Listing

## Purpose

Display a larger catalog of watches.

---

## Layout Structure

```text
Top Navigation

Search + Filter

Section Header

Product Grid
```

---

# Top Navigation

## Back Button

```yaml
icon: arrow-left
```

---

## Menu Button

```yaml
icon: hamburger
```

---

## Cart Button

```yaml
icon: shopping-bag
```

---

# Search Area

Uses same component from Home Screen.

```yaml
Search Input
Filter Button
```

---

# Section Header

Title:

```text
For You
```

Action:

```text
See all
```

---

# Product Grid

## Grid Configuration

```yaml
columns: 2
gap: 12px
padding: 16px
```

---

## Product Card Structure

```text
Favorite Button

Product Image

Product Name
Product SKU

Price
Rating
```

---

## Example Products

### Lunar Edge

```yaml
sku: LE2104
price: $1,429
rating: 4.9
```

### Nova Pulse

```yaml
sku: NP3307
price: $2,649
rating: 5.0
```

### Silver Orbit

```yaml
sku: SO8811
price: $3,189
rating: 4.7
```

### Velocity Prime

```yaml
sku: VP1056
price: $1,575
rating: 4.5
```

---

# Reusable Components

## Avatar

```yaml
shape: circle
```

---

## Search Bar

```yaml
icon-left: search
placeholder: Search...
```

---

## Filter Button

```yaml
icon: sliders
```

---

## Product Card

```yaml
image
wishlist
title
sku
price
rating
```

---

## Brand Chip

```yaml
logo
brand-name
```

---

## Section Header

```yaml
title
action-link
```

---

## Bottom Navigation

```yaml
home
favorites
explore
profile
assistant
```

---

# Component Hierarchy

```text
App
│
├── OnboardingScreen
│   ├── StepIndicator
│   ├── SkipButton
│   ├── HeroImage
│   ├── Heading
│   └── CTAButton
│
├── HomeScreen
│   ├── Header
│   ├── SearchBar
│   ├── BrandCarousel
│   ├── CollectionGrid
│   └── BottomNavigation
│
└── ProductListingScreen
    ├── TopNavigation
    ├── SearchBar
    ├── SectionHeader
    └── ProductGrid
```

# Responsive Notes

- Designed for 390×844 mobile viewport.
- Supports modern iOS and Android devices.
- Uses 16px outer spacing.
- Product cards scale to available width.
- Bottom navigation remains fixed.
- Search bar remains sticky during scrolling.