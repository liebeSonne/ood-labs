package com.lab9v1.view;

import com.lab9v1.model.*;

import javax.swing.*;
import java.awt.*;

public class Chart extends JPanel implements DocumentObserver {

    public Chart(ImmutableDocument document) {
        super();

        ChartBackgroundConfig backgroundConfig = new ChartBackgroundConfig();
        ChartBackground background = new ChartBackground(backgroundConfig);

        ChartHarmonicaConfig harmonicaConfig = new ChartHarmonicaConfig();
        ChartHarmonica harmonica = new ChartHarmonica(harmonicaConfig, document);

        this.add(background);
        this.add(harmonica);
    }

    public void update() {
        this.paintComponents(this.getGraphics());
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);

        g.setColor(Color.WHITE);
        g.fillRect(0, 0, getWidth(), getHeight());

        Graphics2D g2 = (Graphics2D) g;

        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);
    }
}
