import os

replacements = {
    '[#1C2C1F]': 'omni-dark',
    '#1C2C1F': '#1C2C1F', # for cases not in brackets? No, let's just do bracketed tailwind classes.
}

# Wait, Tailwind classes are like bg-[#1C2C1F]. We want bg-omni-dark.
# So replacing '[#1C2C1F]' with 'omni-dark' works perfectly for bg-[...], text-[...], border-[...].

tailwind_replacements = {
    '[#1C2C1F]': 'omni-dark',
    '[#EBF4E3]': 'omni-light',
    '[#FDB854]': 'omni-accent',
    '[#7A9E7E]': 'omni-secondary',
    '[#567558]': 'omni-button',
    '[#415B45]': 'omni-button-hover',
    '[#e89e3a]': 'omni-accent-hover',
    '[#4F6854]': 'omni-text-muted',
    '[#d2e3c9]': 'omni-border',
    '[#2C4131]': 'omni-dark-border',
    '[#2A3E2F]': 'omni-dark-hover',
}

theme_dir = '/Users/kabayangroup/omnichannel.biz.id/wp-content/themes/omni-theme'

for root, _, files in os.walk(theme_dir):
    for file in files:
        if file.endswith('.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r') as f:
                content = f.read()
            
            original_content = content
            for old, new in tailwind_replacements.items():
                content = content.replace(old, new)
                
            if content != original_content:
                with open(filepath, 'w') as f:
                    f.write(content)
                print(f"Updated {file}")
