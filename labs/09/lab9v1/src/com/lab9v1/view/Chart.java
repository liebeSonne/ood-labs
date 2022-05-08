package com.lab9v1.view;

import com.lab9v1.model.DocumentObserver;
import com.lab9v1.model.Harmonica;
import com.lab9v1.model.ImmutableDocument;


import javax.swing.*;
import java.awt.*;

public class Chart extends JPanel implements DocumentObserver {

    int pointSize = 80;
    private int padding = 15;
    private int labelPadding = 15;

    private Color gridColor = new Color(200, 200, 200, 200);
    private Color backgroundColor = Color.WHITE;

    private ImmutableDocument document;
    public Chart(ImmutableDocument document) {
        super();
        System.out.println("Chart.new");
        this.document = document;
        this.document.register(this);
    }

    public void update() {
        System.out.println("Chart.update");
        this.paintComponents(this.getGraphics());
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);

        System.out.println("Chart.paintComponents");
        Graphics2D g2 = (Graphics2D) g;

        this.drawBackground(g2);

        this.document.getHarmonics().forEach(harmonica -> {
            this.drawHarmonica(g2, harmonica);
        });
    }

    private void drawBackground(Graphics2D g2) {
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        int x0 = padding + labelPadding;
        int y0 = padding;
        int width = getWidth() - (2 * padding) - labelPadding;
        int height = getHeight() - (2 * padding);

        int minX = x0;
        int maxX = x0 + width;
        int minY = y0;
        int maxY = y0 + height;

        Point point0 = new Point(x0, y0 + (int) height / 2);

        int hatchMarkSize = (int) pointSize / 4;

        // draw white background
        g2.setColor(backgroundColor);
        g2.fillRect(x0, y0, width, height);

        // draw grids y
        g2.setColor(gridColor);
        g2.drawLine(x0, y0, x0 , maxY);

        // draw grids x
        g2.setColor(gridColor);
        g2.drawLine(x0, point0.y, maxX , point0.y );

        // draw hatch marks y
        g2.setColor(gridColor);
        for (int yi = point0.y; yi <= maxY; yi += pointSize) {
            g2.drawLine(x0 , yi, maxX , yi);
        }
        for (int yi = point0.y; yi >= minY; yi -= pointSize) {
            g2.drawLine(x0 , yi, maxX , yi);
        }

        // draw hatch marks x
        g2.setColor(gridColor);
        for (int xi = point0.x; xi <= maxX; xi += pointSize) {
            g2.drawLine(xi, point0.y - (int) hatchMarkSize / 2, xi, point0.y + (int) hatchMarkSize / 2);
        }
        for (int xi = point0.x; xi >= minX; xi -= pointSize) {
            g2.drawLine(xi, point0.y - (int) hatchMarkSize / 2, xi, point0.y + (int) hatchMarkSize / 2);
        }

        // draw hatch marks text x
        g2.setColor(gridColor);
        double px = 0;
        for (int xi = point0.x; xi <= maxX; xi += pointSize / 2, px += 0.5) {
            String xLabel = px + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelHeight = metrics.getHeight();
            g2.drawString(xLabel, xi, point0.y + hatchMarkSize / 2 + labelHeight + 5);
        }
        px = 0;
        for (int xi = point0.x; xi >= minX; xi -= pointSize / 2, px -= 0.5) {
            String xLabel = px + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelHeight = metrics.getHeight();
            g2.drawString(xLabel, xi, point0.y + hatchMarkSize / 2 + labelHeight + 5);
        }

        // draw hatch marks text y
        g2.setColor(gridColor);
        int py = 0;
        for (int yi = point0.y; yi <= maxY; yi += pointSize, py += 1) {
            String yLabel = py + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelWidth = metrics.stringWidth(yLabel);
            g2.drawString(yLabel, x0 - labelWidth - 5, yi);
        }
        py = 0;
        for (int yi = point0.y; yi >= minY; yi -= pointSize, py -= 1) {
            String yLabel = py + "";
            FontMetrics metrics = g2.getFontMetrics();
            int labelWidth = metrics.stringWidth(yLabel);
            g2.drawString(yLabel, x0 - labelWidth - 5, yi);
        }
    }

    private void drawHarmonica(Graphics2D g2, Harmonica harmonica) {
        // TODO - draw current harmonica
        System.out.println("TODO - draw harmonica");
    }

}
